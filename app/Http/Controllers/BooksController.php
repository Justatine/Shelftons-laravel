<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Archive;
use App\Models\Borrowdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function viewBooks(Request $request)
    {
        $student = [];

        if ($request->has('view-all')) {
            $query = "SELECT * FROM books 
                      LEFT JOIN authors ON books.ISBN = authors.ISBN";
        } elseif ($request->has('book-category') && !empty($request->input('book-category'))) {
            $cats = $request->input('book-category');
            $query = "SELECT * FROM book 
                      LEFT JOIN authors ON books.ISBN = authors.ISBN
                      WHERE books.bookCat = ?";
            $student = DB::select($query, [$cats]);
        } else {
            $query = "SELECT * FROM books
                      LEFT JOIN authors ON books.ISBN = authors.ISBN";
        }

        $result = DB::select($query);

        if (!empty($result)) {
            $student = $result;
        } else {
            $student = ['data' => '0 results'];
        }

        return response()->json($student);
    }
    public function getBookDetails(Request $request)
    {
        $isbn = $request->input('id');

        $query = "SELECT books.ISBN AS bookISBN, books.bookImg, books.bookTitle, books.bookDesc, books.bookCat, books.publisher, 
                  books.yearPublished, books.date_added, books.popularity, books.replacementCost, books.stocks, 
                  authors.ISBN as authorISBN, authors.author_fullname, borrowdetails.borrowStatus  
                  FROM books
                  INNER JOIN authors ON books.ISBN = authors.ISBN 
                  LEFT JOIN borrowdetails ON books.ISBN = borrowdetails.ISBN 
                  WHERE books.ISBN = ?";

        $result = DB::select($query, [$isbn]);

        if (!empty($result)) {
            $response = $result;
        } else {
            $response = ['data' => '0 results'];
        }

        return response()->json($response);
    }
    public function addBook(Request $request)
    {
        $isbn = $request->input('ISBN');
        $bt = $request->input('bookTitle');
        $bd = $request->input('bookDesc');
        $bc = $request->input('bookCat');
        $pub = $request->input('publisher');
        $yrpub = $request->input('yearPublished');
        $repcos = $request->input('replacementCost');
        $stocks = $request->input('stocks');
        $afn = $request->input('author_fullname');
        $img = $request->file('bookImg');

        $imgName = time() . '-' . $img->getClientOriginalName();
        $img->move(public_path('book-imgs'), $imgName);

        DB::beginTransaction();

        try {
            DB::table('books')->insert([
                'ISBN' => $isbn,
                'bookImg' => $imgName,
                'bookTitle' => $bt,
                'bookDesc' => $bd,
                'bookCat' => $bc,
                'publisher' => $pub,
                'yearPublished' => $yrpub,
                'replacementCost' => $repcos,
                'stocks' => $stocks,
            ]);

            DB::table('authors')->insert([
                'ISBN' => $isbn,
                'author_fullname' => $afn,
            ]);

            DB::commit();

            return response()->json(['message' => 'Book added successfully', 'messageType' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }
    public function getBookCategories()
    {
        $categories = DB::table('books')
            ->select('bookCat')
            ->groupBy('bookCat')
            ->get();

        return response()->json($categories);
    }
    public function deleteBook(Request $request)
    {
        $isbn = $request->input('id');
        $response = [];
    
        $imageFilename = DB::table('books')->where('ISBN', $isbn)->value('bookImg');
        $imagePath = public_path('book-imgs/' . $imageFilename);
    
        // Check if bookImg is not default.png before attempting to delete the image
        if (!empty($imageFilename) && $imageFilename !== 'default.png' && file_exists($imagePath)) {
            if (unlink($imagePath)) {
                // Image deleted successfully
            } else {
                return response()->json(['message' => 'Error deleting image file!', 'messageType' => 'failed']);
            }
        }
    
        // Adjust the table names to match your database
        DB::table('borrowdetails')->where('ISBN', $isbn)->delete();
        DB::table('authors')->where('ISBN', $isbn)->delete();
    
        $deleted = DB::table('books')->where('ISBN', $isbn)->delete();
    
        if ($deleted) {
            $response = [
                'messageType' => 'success',
                'message' => 'Book deleted successfully!'
            ];
        } else {
            $response = [
                'messageType' => 'failed',
                'message' => 'Failed to delete book.'
            ];
        }
    
        return response()->json($response);
    } 
    public function updateBook(Request $request)
    {
        $isbn = $request->input('eisbn');
        $bt = $request->input('ebookTitle');
        $bd = $request->input('ebookDesc');
        $bc = $request->input('ebookCat');
        $pub = $request->input('epublisher');
        $yrpub = $request->input('eyearPublished');
        $repcos = $request->input('ereplacementCost');
        $stock = $request->input('estocks');
        $afn = $request->input('eauthor_fullname');

        $newbookimg = $request->file('newbookimg');
        $empty = $newbookimg ? 'false' : 'true';

        $imageFilename = DB::table('books')->where('ISBN', $isbn)->value('bookImg');
        $imagePath = public_path('book-imgs/' . $imageFilename);

        if ($empty == 'false') {
            if (!empty($imageFilename) && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $newbookimgName = time() . '-' . $newbookimg->getClientOriginalName();
            $newbookimg->move('book-imgs/', $newbookimgName);
        }

        $updatedBook = DB::table('books')
            ->where('ISBN', $isbn)
            ->update([
                'bookImg' => $empty == 'false' ? $newbookimgName : DB::raw('bookImg'),
                'bookTitle' => $bt,
                'bookDesc' => $bd,
                'bookCat' => $bc,
                'publisher' => $pub,
                'yearPublished' => $yrpub,
                'replacementCost' => $repcos,
                'stocks' => $stock,
            ]);

        $updatedAuthor = DB::table('authors')
            ->where('ISBN', $isbn)
            ->update([
                'author_fullname' => $afn,
            ]);

        if ($updatedBook !== false && $updatedAuthor !== false) {
            return response()->json(['message' => 'Book updated successfully!', 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'Failed to update book.', 'messageType' => 'failed']);
        }
    }   
     // Borrow control
    public function borrowControl(Request $request){
        $userid = $request->input('userid');
        $isbn = $request->input('isbn');
        
        $book = Book::select(
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
                'borrowdetail.returnStatus'
            )
            ->join('author', 'book.ISBN', '=', 'author.ISBN')
            ->leftJoin('borrowdetail', 'book.ISBN', '=', 'borrowdetail.ISBN')
            ->where('borrowdetail.userID', $userid)
            ->where('borrowdetail.ISBN', $isbn)
            ->first();

        $response = [];

        if ($book) {
            if ($book->borrowStatus === 'Pending' || $book->borrowStatus === 'Approved') {
                $response['borrowed'] = 'borrowed';
            } else {
                $response['not_borrowed'] = 'not_borrowed';
            }
        } else {
            $response['no_borrow'] = 'no borrowed books';
        }

        return response()->json($response);
    }
    // Categories update
    public function getGroupCategories(){
        $books = Book::select('bookCat')->groupBy('bookCat')->get();
        
        if ($books->count() > 0) {
            return response()->json(['status' => "success", 'data'=> $books], 200);
        } else {
            return response()->json(['status' => "success", 'data'=> 'No results'], 200);
        }
    }
    // Check limit
    public function checkLimit(Request $request){
    $user_id = $request->input('user_id');

    $borrowCount = Borrowdetail::where('userID', $user_id)->count();

    $response = [];

    if ($borrowCount === 3) {
        $response['limit'] = 'limit';
    } else {
        $response['notlimit'] = 'notlimit';
    }
    return response()->json(['status' => "success", 'data'=> $response], 200);
    }
    // Check lost
    public function checkLost(Request $request){
        $user_id = $request->input('user_id');
    
        $borrowDetails = Borrowdetail::where('userID', $user_id)->get();
        $response = [];
    
        if ($borrowDetails->count() > 0) {
            foreach ($borrowDetails as $detail) {
                if ($detail->returnStatus === 'Lost') {
                    $response['lost'] = 'lost';
                    break;
                }
            }
    
            if (!isset($response['lost'])) {
                $response['notlost'] = 'not lost';
            }
        } else {
            $archive = Archive::where('userID', $user_id)->get();
    
            if ($archive->count() > 0) {
                foreach ($archive as $item) {
                    if ($item->bookStatus === 'Lost' && $item->status_when_lost === 'Unpaid') {
                        $response['lost'] = 'lost';
                        break;
                    }
                }
            }
    
            $response['no_borrow'] = 'no borrowed books';
        }
        return response()->json(['status' => "success", 'data'=> $response], 200);
    }
    // Check due
    public function checkDue(Request $request){
        $user_id = $request->input('userid');
        $borrowDetails = Borrowdetail::where('userID', $user_id)->get();

        $response = [];

        if ($borrowDetails->isNotEmpty()) {
            foreach ($borrowDetails as $borrowDetail) {
                if ($borrowDetail->borrowStatus === 'Overdue') {
                    $response['overdue'] = 'overdue';
                } else {
                    $response['not_due'] = 'no overdue';
                }
            }
        } else {
            $response['not_due'] = 'no dues';
        }
            return response()->json(['status' => "success", 'data'=> $response], 200);
    }
    // Drop categories
    public function dropCategories(){
        $student = DB::table('book')
            ->select('bookCat')
            ->groupBy('bookCat')
            ->get();

        if ($student->isEmpty()) {
            return response()->json(['status' => "success", 'data'=> 'No categories'], 200);
        }
            return response()->json(['status' => "success", 'data'=> $student], 200);
    }
    // New releases
    public function newReleases(){
        $books = DB::table('books')
            ->leftJoin('authors', 'books.ISBN', '=', 'authors.ISBN')
            ->orderBy('books.date_added', 'DESC')
            ->limit(5)
            ->get();

        if ($books->count() > 0) {
            $data = $books->toArray();
        } else {
            $data = [];
        }
        return response()->json($data);
    }
    public function popular()
    {
        $result = DB::table('books')
            ->leftJoin('authors', 'books.ISBN', '=', 'authors.ISBN')
            ->orderBy('books.popularity', 'DESC')
            ->limit(5)
            ->get();

        if ($result->isNotEmpty()) {
            $books = $result->toArray();
            return response()->json($books);
        } else {
            return response()->json(['message' => 'No results'], 404);
        }
    }
    public function showBooks(Request $request)
    {
        $isbn = $request->input('id');

        $bookDetails = DB::table('books')
            ->select('books.ISBN as bookISBN', 'books.bookImg', 'books.bookTitle', 'books.bookDesc', 'books.bookCat', 'books.publisher', 'books.yearPublished', 'books.date_added', 'books.popularity', 'books.replacementCost', 'books.stocks', 'authors.ISBN as authorISBN', 'authors.author_fullname', 'borrowdetails.borrowStatus', 'borrowdetails.returnStatus', 'borrowdetails.fine')
            ->join('authors', 'books.ISBN', '=', 'authors.ISBN')
            ->leftJoin('borrowdetails', 'books.ISBN', '=', 'borrowdetails.ISBN')
            ->where('books.ISBN', '=', $isbn)
            ->get();

        if ($bookDetails->count() > 0) {
            $response = $bookDetails->toArray();
        } else {
            $response = [];
        }

        return response()->json($response);
    }
    
    // Popularity
    public function popularity(){
        $books = DB::table('book')
            ->leftJoin('author', 'book.ISBN', '=', 'author.ISBN')
            ->orderBy('book.popularity', 'DESC')
            ->limit(5)
            ->get();
            
        if ($books->isNotEmpty()) {
            return response()->json(['status' => "success", 'data'=> $books], 200);
        } else {
            return response()->json(['status' => "success", 'data'=> 'No books found'], 200);
        }
    }
    // Get single book
    public function getSingleBook(Request $request){
        $isbn = $request->input('id');

        $bookData = DB::table('book')
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
                'borrowdetail.borrowStatus'
            )
            ->join('author', 'book.ISBN', '=', 'author.ISBN')
            ->leftJoin('borrowdetail', 'book.ISBN', '=', 'borrowdetail.ISBN')
            ->where('book.ISBN', $isbn)
            ->get();

        if ($bookData->isNotEmpty()) {
            return response()->json(['status' => "success", 'data'=> $bookData], 200);
        } else {
            return response()->json(['status' => "success", 'data'=> 'No book/s found'], 200);
        }
    }
}
            // return response()->json(['status' => "success", 'data'=> $bookDetails], 200);
