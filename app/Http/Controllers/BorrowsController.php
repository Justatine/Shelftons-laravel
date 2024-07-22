<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Archive;
use App\Models\Borrowdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BorrowsController extends Controller
{
    // archive records
    public function archive(Request $request)
    {
        $result = DB::table('books')
            ->join('borrowdetails', 'books.ISBN', '=', 'borrowdetails.ISBN')
            ->select(
                'borrowdetails.borrowID',
                'borrowdetails.userID',
                'borrowdetails.ISBN AS borrowISBN',
                'borrowdetails.borrowDate',
                'borrowdetails.returnSchedule',
                'borrowdetails.returnDate',
                'borrowdetails.borrowStatus',
                'borrowdetails.returnStatus',
                'borrowdetails.fine',
                'books.ISBN AS bookISBN',
                'books.bookTitle',
                'books.bookImg',
                'books.replacementCost AS borrowFine'
            )
            ->get();

        if ($result->count() > 0) {
            $response = $result->toArray();
        } else {
            $response['data'] = 'no_data';
        }

        return response()->json($response);
    }
    // delete borrow
    public function deleteBorrow(Request $request)
    {
        $borrowID = $request->input('id');

        $deleted = DB::table('borrowdetails')->where('borrowID', $borrowID)->delete();

        if ($deleted) {
            $msg = "Borrow deleted successfully";
            return response()->json(['message' => $msg, 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }
    public function updateBorrow(Request $request)
    {
        $currentDate = now();
        $threeDaysLater = $currentDate->addDays(3);

        $bid = $request->input('borrowID');
        $bookid = $request->input('bookid');
        $resched = $request->input('returnSchedule');
        $retdate = $request->input('returnDate');
        $borrstat = $request->input('borrowStatus');
        $retstat = $request->input('returnStatus');
        $fine = $request->input('fine');

        $borrowDetails = DB::table('borrowdetails')
            ->join('books', 'borrowdetails.ISBN', '=', 'books.ISBN')
            ->where('borrowdetails.borrowID', '=', $bid)
            ->first();

        $stock = $borrowDetails->stocks;
        $newfine = $borrowDetails->replacementCost;
        $hourlyFine = 10;

        $updateData = [
            'returnSchedule' => $threeDaysLater,
            'returnDate' => $retdate,
            'borrowStatus' => $borrstat,
            'returnStatus' => $retstat,
            'fine' => $fine,
        ];

        DB::table('borrowdetails')->where('borrowID', '=', $bid)->update($updateData);

        if ($borrstat === 'Overdue') {
            DB::table('borrowdetails')->where('borrowID', '=', $bid)->update(['fine' => $hourlyFine]);
        }

        if ($borrstat === 'Approved' && $retstat === 'Not returned') {
            DB::table('books')->where('ISBN', '=', $bookid)->decrement('stocks');
        } elseif ($borrstat === 'Cancelled') {
            DB::table('books')->where('ISBN', '=', $bookid)->increment('stocks');
        } elseif ($borrstat === 'Approved' && $retstat === 'Returned' && $retdate !== null) {
            DB::table('books')->where('ISBN', '=', $bookid)->increment('stocks');
        } elseif ($borrstat === 'Approved' && $retstat === 'Lost' && $retdate === null) {
            DB::table('books')->where('ISBN', '=', $bookid)->decrement('stocks');
        }

        return response()->json(['message' => 'Transaction updated successfully', 'messageType' => 'success']);
    }
    public function sendToArchive(Request $request)
    {
        $bid = $request->input('borrowID');
        $isbn = $request->input('isbn');
        $uid = $request->input('userid');
        $bd = $request->input('archive__borrowDate');
        $rd = $request->input('archive_returnDate');
        $rs = $request->input('archive_returnStatus');
        $fine = $request->input('archive_fine');

        try {
            DB::beginTransaction();

            DB::table('archives')->insert([
                'borrowID' => $bid,
                'ISBN' => $isbn,
                'userID' => $uid,
                'borrowDate' => $bd,
                'returnDate' => $rd,
                'bookStatus' => $rs,
                'fine' => $fine,
            ]);

            DB::table('borrowdetails')->where('borrowID', '=', $bid)->delete();

            DB::commit();

            return response()->json(['message' => 'Archived successfully!', 'messageType' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }
    public function archiveLost(Request $request)
    {
        $bid = $request->input('lost_archive_borrowID');
        $isbn = $request->input('lost_archive_isbn');
        $uid = $request->input('lost_archive_userid');
        $bd = $request->input('lost_archive__borrowDate');
        $rd = $request->input('lost_archive__returnDate');
        $rs = $request->input('lost_archive_returnStatus');
        $lf = $request->input('lost_archive_fine');

        $query = "SELECT stocks FROM books WHERE books.ISBN = ?";
        $stocksValue = DB::select($query, [$isbn]);
        
        if($stocksValue > 0){
        $query = "INSERT INTO `archives` (`borrowID`, `ISBN`, `userID`, `borrowDate`, `returnDate`, `bookStatus`, `fine`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        DB::insert($query, [$bid, $isbn, $uid, $bd, $rd, $rs, $lf]);

        $query1 = "DELETE FROM borrowdetails WHERE borrowID = ?";
        $res1 = DB::delete($query1, [$bid]);
        if($res1){
            return response()->json(['message' => 'Archived successfully!', 'messageType' => 'success']);
        }else{
            return response()->json(['message' => 'Archived failed', 'messageType' => 'success']);
        }
        }else{
            $query = "INSERT INTO `archives` (`borrowID`, `ISBN`, `userID`, `borrowDate`, `returnDate`, `bookStatus`, `fine`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            DB::insert($query, [$bid, $isbn, $uid, $bd, $rd, $rs, $lf]);
    
            $query1 = "DELETE FROM borrowdetails WHERE borrowID = ?";
            DB::delete($query1, [$bid]);

            $query2 = "DELETE FROM authors WHERE ISBN = ?";
            DB::delete($query2, [$isbn]);

            $imageFilename = DB::table('books')->where('ISBN', $isbn)->value('bookImg');
            if (!empty($imageFilename)) {
                $imagePath = "book-imgs/" . $imageFilename;
                if (File::exists($imagePath)) {
                    if (File::delete($imagePath)) {
                        // echo "Image file deleted successfully!";
                    } else {
                        // echo "Error deleting image file!";
                    }
                }
            }
            $query3 = "DELETE FROM books WHERE ISBN = ?";
            $res3 = DB::delete($query3, [$isbn]);
            if($res3){
                return response()->json(['message' => 'Archived successfully!', 'messageType' => 'success']);
            }else{
                return response()->json(['message' => 'Archived failed', 'messageType' => 'success']);
            }
        }
    }
    // Borrow api
    public function addData(Request $request){
        $userid = $request->input('userid');
        $id = $request->input('id');
        $currentTimestamp = time();
        $returnScheduleTimestamp = $currentTimestamp + (3 * 24 * 60 * 60);
        $returnScheduleDate = date('Y-m-d', $returnScheduleTimestamp);
    
        $borrowDetail = new BorrowDetail();
        $borrowDetail->userID = $userid;
        $borrowDetail->ISBN = $id;
        $borrowDetail->borrowDate = now(); // or use Carbon\Carbon for better date manipulation
        $borrowDetail->returnSchedule = $returnScheduleDate;
        $borrowDetail->borrowStatus = 'Pending';
        $borrowDetail->fine = '0.00';
        
        $book = Book::where('ISBN', $id)->first();
        
        if ($borrowDetail->save() && $book) {
            $book->popularity += 1;
            $book->save();
            $msg = "Book borrowed successfully";
            return response()->json(['message' => $msg, 'status' => 'success']);
        } elseif (!$book) {
            return response()->json(['message' => 'Book not found', 'status' => 'failed']);
        } else {
            return response()->json(['message' => 'Failed to borrow book', 'status' => 'failed']);
        }
    }
    
    // returned records
    public function getReturnedBooks()
    {
        $returnedBooks = DB::table('archives')
            ->where('bookStatus', 'Returned')
            ->get();

        if ($returnedBooks->count() > 0) {
            return response()->json(['data' => $returnedBooks]);
        } else {
            return response()->json(['data' => 'no_data']);
        }
    }
    // Delete borrow data
    public function deleteData(Request $request){
        $borrowID = $request->input('id');
        $deleted = DB::table('borrowdetail')->where('borrowID', $borrowID)->delete();

        if ($deleted) {
            $msg = "Borrow deleted successfully";
            return response()->json(['message' => $msg, 'status' => 'success']);
        } else {
            return response()->json(['message' => 'Failed to delete record', 'status' => 'failed']);
        }
    }
    // Lost archive
    public function lostArchive(Request $request) {
        $bid = $request->input('lost_archive_borrowID');
        $isbn = $request->input('lost_archive_isbn');
        $uid = $request->input('lost_archive_userid');
        $bd = $request->input('lost_archive__borrowDate');
        $rd = $request->input('lost_archive__returnDate');
        $rs = $request->input('lost_archive_returnStatus');
        $lf = $request->input('lost_archive_fine');
        
        $archive = new Archive();
        $archive->borrowID = $bid;
        $archive->ISBN = $isbn;
        $archive->userID = $uid;
        $archive->borrowDate = $bd;
        $archive->returnDate = $rd;
        $archive->bookStatus = $rs;
        $archive->fine = $lf;
        $archive->save();
        
        $borrowDetailDeleted = BorrowDetail::where('borrowID', $bid)->delete();
        $authorDeleted = Author::where('ISBN', $isbn)->delete();
        
        $book = Book::where('ISBN', $isbn)->first();
        $imageFilename = $book->bookImg ?? null;
        
        if (!empty($imageFilename)) {
            $imagePath = public_path("book-imgs/" . $imageFilename); 
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        
        $bookDeleted = Book::where('ISBN', $isbn)->delete();
        
        if ($bookDeleted) {
            return response()->json(['message' => 'Archived successfully!', 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }
    // Get lost from archive
    public function getLostBooksFromArchive()
    {
        $lostBooks = DB::table('archives')
            ->where('bookStatus', 'Lost')
            ->get();

        if ($lostBooks->count() > 0) {
            return response()->json($lostBooks);
        } else {
            return response()->json(['data' => 'no_data']);
        }
    }
    public function updateStatusWhenLost(Request $request)
    {
        $request->validate([
            'archive_id_paid' => 'required',
        ]);

        $aid = $request->input('archive_id_paid');

        try {
            DB::table('archives')
                ->where('archiveID', $aid)
                ->update(['status_when_lost' => 'Paid']);

            $msg = "Lost book updated successfully";
            return response()->json(['message' => $msg, 'messageType' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }
    // Own borrows
    public function getBorrowDetails(Request $request)
    {
        $id = $request->input('id');

        $borrowDetails = DB::table('books')
            ->join('borrowdetails', 'books.ISBN', '=', 'borrowdetails.ISBN')
            ->select(
                'borrowdetails.borrowID',
                'borrowdetails.userID',
                'borrowdetails.ISBN AS borrowISBN',
                'borrowdetails.borrowDate',
                'borrowdetails.returnSchedule',
                'borrowdetails.returnDate',
                'borrowdetails.borrowStatus',
                'borrowdetails.returnStatus',
                'borrowdetails.fine',
                'books.ISBN AS bookISBN',
                'books.bookTitle',
                'books.bookImg',
                'books.replacementCost AS borrowFine'
            )
            ->where('borrowdetails.userID', $id)
            ->get();

        if ($borrowDetails->isEmpty()) {
            $response = ['data' => 'no_data'];
        } else {
            $response = $borrowDetails->toArray();
        }
        return response()->json($response);
    }
    public function borrowBook(Request $request)
    {
        $userid = $request->input('userid');
        $id = $request->input('id');
        $currentTimestamp = time();
        $returnScheduleTimestamp = $currentTimestamp + (3 * 24 * 60 * 60);
        $returnScheduleDate = date('Y-m-d', $returnScheduleTimestamp);

        DB::beginTransaction();

        try {
            DB::table('borrowdetails')->insert([
                'userID' => $userid,
                'ISBN' => $id,
                'borrowDate' => now(),
                'returnSchedule' => $returnScheduleDate,
                'borrowStatus' => 'Pending',
                'fine' => '0.00'
            ]);

            DB::table('books')
                ->where('ISBN', $id)
                ->update(['popularity' => DB::raw('popularity + 1')]);

            DB::commit();

            return response()->json(['message' => 'Book borrowed successfully!', 'messageType' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }
    public function checkBorrowStatus(Request $request)
    {
        $user_id = $request->input('user_id');

        $borrowDetails = DB::table('borrowdetails')->where('userID', $user_id)->get();

        $response = [];

        if ($borrowDetails->isNotEmpty()) {
            foreach ($borrowDetails as $row) {
                if ($row->returnStatus === 'Lost') {
                    $response['lost'] = 'lost';
                    break;
                }
            }

            if (!isset($response['lost'])) {
                $response['notlost'] = 'not lost';
            }
        } else {
            $archiveDetails = DB::table('archives')->where('userID', $user_id)->get();

            if ($archiveDetails->isNotEmpty()) {
                foreach ($archiveDetails as $row) {
                    if ($row->bookStatus === 'Lost' && $row->status_when_lost === 'Unpaid') {
                        $response['lost'] = 'lost';
                        break;
                    }
                }
            }
            $response['no_borrow'] = 'no borrowed books';
        }

        return response()->json($response);
    }
    public function checkBorrowLimit(Request $request)
    {
        $user_id = $request->input('user_id');

        $borrowCount = DB::table('borrowdetails')->where('userID', $user_id)->count();

        $response = [];

        if ($borrowCount === 3) {
            $response['limit'] = 'limit';
        } else {
            $response['notlimit'] = 'notlimit';
        }

        return response()->json($response);
    }
    
    // Paid from archive
    public function paidFromArchive(Request $request){
        $archiveId = $request->input('archive_id_paid');

        $archive = Archive::where('archiveID', $archiveId)->first();

        if ($archive) {
            $archive->status_when_lost = 'Paid';
            $archive->save();

            return response()->json(['message' => 'Lost book updated successfully!','status' => 'success']);
        } else {
            return response()->json(['message' => 'Archive not found','status' => 'failed']);
        }
    }
    // Returns
    public function returnIntoArchive(Request $request){
        $bid = $request->input('borrowID');
        $isbn = $request->input('isbn');
        $uid = $request->input('userid');
        $bd = $request->input('archive__borrowDate');
        $rd = $request->input('archive_returnDate');
        $rs = $request->input('archive_returnStatus');
        $fine = $request->input('archive_fine');
    
        $query = "INSERT INTO `archive` (`borrowID`, `ISBN`, `userID`, `borrowDate`, `returnDate`, `bookStatus`, `fine`)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        $success = DB::insert($query, [$bid, $isbn, $uid, $bd, $rd, $rs, $fine]);
    
        if ($success) {
            $query1 = "DELETE FROM borrowdetail WHERE borrowID = ?";
            $success1 = DB::delete($query1, [$bid]);
    
            if ($success1) {
                return response()->json(['message' => 'Archived successfully', 'status' => 'success']);
            } else {
                return response()->json(['message' => 'Failed', 'status' => 'failed']);
            }
        } else {
            return response()->json(['message' => 'Failed', 'status' => 'failed']);
        }
    }
    // Schedules
    public function schedules(){
        $borrowDetails = DB::table('borrowdetails')
            ->select(
                'books.ISBN as bookISBN',
                'books.bookImg',
                'books.bookTitle',
                'books.bookDesc',
                'books.bookCat',
                'books.publisher',
                'books.yearPublished',
                'books.date_added',
                'books.popularity',
                'books.replacementCost',
                'books.stocks',
                'authors.ISBN as authorISBN',
                'authors.author_fullname',
                'borrowdetails.borrowStatus',
                'borrowdetails.returnStatus',
                'borrowdetails.returnSchedule',
                'accounts.firstname',
                'accounts.middlename',
                'accounts.lastname'
            )
            ->join('books', 'borrowdetails.ISBN', '=', 'books.ISBN')
            ->join('authors', 'books.ISBN', '=', 'authors.ISBN')
            ->leftJoin('accounts', 'borrowdetails.userID', '=', 'accounts.userID')
            ->where('borrowdetails.borrowStatus', '=', 'Approved')
            ->get();

        if ($borrowDetails->isNotEmpty()) {
        return response()->json(['status' => "success", 'data'=> $borrowDetails], 200);
    } else {
        return response()->json(['status' => "success", 'data'=> 'no_borrows'], 200);
        }
    }
    // Stock update
    public function stockUpdates(Request $request){
        $user_id = $request->input('user_id');
        $isbn = $request->input('isbn');
        $borrowid = $request->input('bid');

        $borrowDetails = DB::table('borrowdetail')
            ->join('book', 'borrowdetail.ISBN', '=', 'book.ISBN')
            ->where('borrowdetail.borrowID', '=', $borrowid)
            ->get();

        $response = [];

        if ($borrowDetails->count() > 0) {
            foreach ($borrowDetails as $row) {
                $stock = $row->stocks;
                $new_stock = ($stock - 1);
                if ($row->borrowStatus === 'Approved') {
                    $affected = DB::table('book')
                        ->where('ISBN', $isbn)
                        ->update(['stocks' => $new_stock]);
                    if ($affected) {
                        $response['stockups'] = 'updated';
                    } else {
                        $response['stockups'] = 'not updated';
                    }
                    break;
                }
            }
        }
        return response()->json(['status' => "success", 'data'=> $response], 200);
    }
    // Update data return
    public function updateDataReturn(Request $request){
        $bid = $request->input('borrowID');
        $fine = $request->input('borrowFine');

        $borrowDetail = BorrowDetail::where('borrowID', $bid)->first();

        if ($borrowDetail) {
            $borrowDetail->returnStatus = 'Lost';
            $borrowDetail->fine = $fine;
            $borrowDetail->save();

            $msg = "Borrow updated successfully";
        return response()->json(['status' => "success", 'data'=> $msg], 200);
    } else {
        return response()->json(['status' => "success", 'data'=> 'Failed to update'], 200);
    }
    }
    // Update per borrow
    public function updatePerBorrow(Request $request) {
        $currentDate = now();
        $newDate = $currentDate->addDays(3)->toDateString();
    
        $bid = $request->input('borrowID');
        $bookid = $request->input('bookid');
        $resched = $request->input('returnSchedule');
        $retdate = $request->input('returnDate');
        $borrstat = $request->input('borrowStatus');
        $retstat = $request->input('returnStatus');
        $fine = $request->input('fine');
    
        $borrowDetail = BorrowDetail::where('borrowID', $bid)->with('book')->firstOrFail();
        $stock = $borrowDetail->book->stocks;
        $newfine = $borrowDetail->book->replacementCost;
        $hourlyfine = 10;
    
        $borrowDetail->returnSchedule = $newDate;
        $borrowDetail->returnDate = $retdate;
        $borrowDetail->borrowStatus = $borrstat;
        $borrowDetail->returnStatus = $retstat;
        $borrowDetail->fine = $fine;
    
        $borrowDetail->save();
    
        if($borrstat === 'Overdue'){
            $borrowDetail->fine = $hourlyfine;
            $borrowDetail->save();
        }
    
        if ($borrstat === 'Approved' && $retstat === 'Not returned') {
            $borrowDetail->book->stocks -= 1;
            $borrowDetail->book->save();
        } else if ($borrstat === 'Cancelled') {
            $borrowDetail->book->stocks += 1;
            $borrowDetail->book->save();
        } else if ($borrstat === 'Approved' && $retstat === 'Returned' && $retdate !== null) {
            $borrowDetail->book->stocks += 1;
            $borrowDetail->book->save();
        } else if ($borrstat === 'Approved' && $retstat === 'Lost' && $retdate === null) {
            $borrowDetail->book->stocks -= 1;
            $borrowDetail->book->save();
        }
        return response()->json(['status' => "success", 'data'=> 'Borrow updated successfully'], 200);
    }
    // Cancel borrow
    public function cancelBorrow(Request $request)
    {
        $borrowID = $request->input('borrowID');
        $borrowStatus = 'Cancelled';

        try {
            DB::beginTransaction();

            DB::table('borrowdetails')
                ->where('borrowID', $borrowID)
                ->update(['borrowStatus' => $borrowStatus]);

            DB::table('books')
                ->where('ISBN', $borrowID)
                ->decrement('popularity', 1);

            DB::commit();

            $response = [
                'messageType' => 'success',
                'message' => 'Borrow updated successfully',
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $response = [
                'messageType' => 'failed',
                'message' => 'Failed to update borrow.',
            ];
        }

        return response()->json($response);
    }
    public function getBookDetails(Request $request)
    {
        $isbn = $request->input('id');

        $bookDetails = DB::table('books')
            ->join('authors', 'books.ISBN', '=', 'authors.ISBN')
            ->leftJoin('borrowdetails', 'books.ISBN', '=', 'borrowdetails.ISBN')
            ->select(
                'books.ISBN AS bookISBN',
                'books.bookImg',
                'books.bookTitle',
                'books.bookDesc',
                'books.bookCat',
                'books.publisher',
                'books.yearPublished',
                'books.date_added',
                'books.popularity',
                'books.replacementCost',
                'books.stocks',
                'authors.ISBN AS authorISBN',
                'authors.author_fullname',
                'borrowdetails.borrowStatus'
            )
            ->where('books.ISBN', $isbn)
            ->get();

        if ($bookDetails->isEmpty()) {
            $response = ['data' => '0 results'];
        } else {
            $response = $bookDetails->toArray();
        }

        return response()->json($response);
    }
    public function updateLost(Request $request)
    {
        $borrowID = $request->input('borrowID');
        $fine = $request->input('borrowFine');

        $query = "UPDATE borrowdetails 
            SET returnStatus='Lost', fine = ? 
            WHERE borrowID = ?";

        $res = DB::update($query, [$fine, $borrowID]);

        if ($res) {
            $response = [
                'messageType' => 'success',
                'message' => 'Borrow updated successfully',
            ];
        } else {
            $response = [
                'messageType' => 'failed',
                'message' => 'Failed to update borrow.',
            ];
        }

        return response()->json($response);
    }
    public function borrowControl(Request $request)
    {
        $userid = $request->input('userid');
        $isbn = $request->input('isbn');

        $result = DB::table('books')
            ->join('authors', 'books.ISBN', '=', 'authors.ISBN')
            ->leftJoin('borrowdetails', function ($join) use ($userid, $isbn) {
                $join->on('books.ISBN', '=', 'borrowdetails.ISBN')
                    ->where('borrowdetails.userID', '=', $userid)
                    ->where('borrowdetails.ISBN', '=', $isbn);
            })
            ->select('books.ISBN as bookISBN', 'books.bookImg', 'books.bookTitle', 'books.bookDesc', 'books.bookCat', 'books.publisher', 'books.yearPublished', 'books.date_added', 'books.popularity', 'books.replacementCost', 'books.stocks', 'authors.ISBN as authorISBN', 'authors.author_fullname', 'borrowdetails.borrowStatus', 'borrowdetails.returnStatus')
            ->first();

        $response = [];

        if ($result) {
            if ($result->borrowStatus === 'Pending' || $result->borrowStatus === 'Approved') {
                $response['borrowed'] = 'borrowed';
            } else {
                $response['not_borrowed'] = 'not_borrowed';
            }
        } else {
            $response['no_borrow'] = 'no borrowed books';
        }

        return response()->json($response);
    }
    public function checkDueStatus(Request $request)
    {
        $user_id = $request->input('userid');

        $result = DB::table('borrowdetails')
            ->where('userID', $user_id)
            ->get();

        $response = [];

        if ($result->isNotEmpty()) {
            foreach ($result as $row) {
                if ($row->borrowStatus === 'Overdue') {
                    $response['overdue'] = 'overdue';
                    break;
                } else {
                    $response['not_due'] = 'no overdue';
                }
            }
        } else {
            $response['not_due'] = 'no dues';
        }

        return response()->json($response);
    }
    public function api1(){
        $students = DB::table('book')
            ->leftJoin('author', 'book.ISBN', '=', 'author.ISBN')
            ->leftJoin('borrowdetail', 'book.ISBN', '=', 'borrowdetail.ISBN')
            ->select(
                'book.ISBN AS bookISBN',
                'book.bookTitle',
                'book.replacementCost',
                'author.ISBN AS authorISBN',
                'borrowdetail.ISBN AS borrowISBN',
                'borrowdetail.borrowStatus AS borrowStatus'
            )
            ->get();

        if ($students->isNotEmpty()) {
        return response()->json(['status' => "success", 'data'=> $students], 200);
    } else {
        return response()->json(['status' => "failed", 'data'=> 'No data'], 200);
    }
    }
    public function api5(){
        $books = Book::orderBy('bookCat', 'ASC')->get();
        
        if ($books->isEmpty()) {
            $response = ['data' => 'no_data'];
        } else {
            $response = $books;
        }
        return response()->json(['status' => "success", 'data'=> $response], 200);
    }
    public function selectBookCategories(){
        $categories = DB::table('book')
            ->select('bookCat')
            ->groupBy('bookCat')
            ->get();

        $student = [];

        if ($categories->isNotEmpty()) {
            foreach ($categories as $category) {
                $categoryName = $category->bookCat;
                $student['$category'] = $category;

                $books = DB::table('book')
                    ->where('bookCat', $categoryName)
                    ->get();

                foreach ($books as $book) {
                    $student['$category'] = $book;
                }
            }
        } else {
            $student['data'] = 'no_data';
        }
        return response()->json(['status' => "success", 'data'=> $student], 200);
    }
        public function getBorrowedBooks()
    {
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");

        if(request()->isMethod('get')) {
            $borrowedBooks = DB::table('borrowdetail')
                ->select(
                    'book.ISBN AS bookISBN',
                    'book.bookImg',
                    'book.bookTitle',
                    'book.bookDesc',
                    'book.bookCat',
                    'book.publisher',
                    'book.yearPublished',
                    'book.date_added',
                    'book.popularity',
                    'book.replacementCost',
                    'book.stocks',
                    'author.ISBN as authorISBN',
                    'author.author_fullname',
                    'borrowdetail.borrowStatus',
                    'borrowdetail.returnStatus',
                    'borrowdetail.returnSchedule',
                    'user.firstname',
                    'user.middlename',
                    'user.lastname'
                )
                ->join('book', 'borrowdetail.ISBN', '=', 'book.ISBN')
                ->join('author', 'book.ISBN', '=', 'author.ISBN')
                ->leftJoin('user', 'borrowdetail.userID', '=', 'user.userID')
                ->where('borrowdetail.borrowStatus', '=', 'Approved')
                ->get();

            if ($borrowedBooks->isNotEmpty()) {
                return response()->json($borrowedBooks);
            } else {
                return response()->json(['no_borrows' => 'no_borrows']);
            }
        } else {
            return response()->json(['message' => 'Internal server error', 'messageType' => '404']);
        }
    }
        // return response()->json(['status' => "success", 'data'=> $bookDetails], 200);
}