<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [RouteController::class, 'index']);
Route::get('/', [RouteController::class, 'index'])->name('gotoIndex');
Route::get('/login', [RouteController::class, 'login'])->name('login');
Route::post('/authenticate', [RouteController::class, 'authenticate'])->name('authenticate');
Route::post('/register', [UserController::class, 'register'])->name('register');

// // Admin side
Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
    Route::get('/index', [RouteController::class, 'adminIndex'])->name('index');
    Route::get('/users', [RouteController::class, 'adminUsers'])->name('users');
    Route::get('/books', [RouteController::class, 'adminBooks'])->name('books');
    Route::get('/borrowers', [RouteController::class, 'adminBorrowers'])->name('borrowers');
    Route::get('/myprofile', [RouteController::class, 'adminProfile'])->name('myprofile');
});
  
  // Incharge side
Route::group(['prefix' => '/librarian', 'as' => 'librarian.'], function () {
    Route::get('/index', [RouteController::class, 'librarianIndex'])->name('index');
    Route::get('/books', [RouteController::class, 'librarianBooks'])->name('books');
    Route::get('/borrowers', [RouteController::class, 'librarianBorrowers'])->name('borrowers');
    Route::get('/myprofile', [RouteController::class, 'librarianProfile'])->name('myprofile');
    Route::get('/users', [RouteController::class, 'librarianUsers'])->name('users');
});
  
// Customer side
Route::group(['prefix' => '/user', 'as' => 'user.'], function () {
    Route::get('/index', [RouteController::class, 'patronIndex'])->name('index');
    Route::get('/schedules', [RouteController::class, 'patronSchedules'])->name('schedules');
    Route::get('/library', [RouteController::class, 'patronLibrary'])->name('library');
    Route::get('/search', [RouteController::class, 'patronSearch'])->name('search');
    Route::get('/profile', [RouteController::class, 'patronProfile'])->name('profile');
});
  
    // Users
    Route::get('/users', [UserController::class, 'getUsers'])->name('users');
    Route::post('/deleteUser', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/updateUser', [UserController::class, 'updateUser'])->name('updateUser');
    Route::post('/createUser', [UserController::class, 'createUser'])->name('createUser');
    Route::post('/createLibrarian', [UserController::class, 'createLibrarian'])->name('createLibrarian');
    Route::post('/createAdmin', [UserController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/getOne', [UserController::class, 'getOne'])->name('getOne');

    // Transaction
    Route::post('/borrowBook', [BorrowsController::class, 'borrowBook'])->name('borrowBook');
    Route::get('/checkBorrowStatus', [BorrowsController::class, 'checkBorrowStatus'])->name('checkBorrowStatus');
    Route::get('/checkBorrowLimit', [BorrowsController::class, 'checkBorrowLimit'])->name('checkBorrowLimit');
    Route::post('/borrowControl', [BorrowsController::class, 'borrowControl'])->name('borrowControl');
    Route::post('/checkDueStatus', [BorrowsController::class, 'checkDueStatus'])->name('checkDueStatus');
    Route::get('/schedules', [BorrowsController::class, 'schedules'])->name('schedules');
    
    
    // Books
    Route::get('/viewBooks', [BooksController::class, 'viewBooks'])->name('viewBooks');
    Route::post('/getBookDetails', [BooksController::class, 'getBookDetails'])->name('getBookDetails');
    Route::post('/addBook', [BooksController::class, 'addBook'])->name('addBook');
    Route::get('/getBookCategories', [BooksController::class, 'getBookCategories'])->name('getBookCategories');
    Route::post('/updateBook', [BooksController::class, 'updateBook'])->name('updateBook');
    Route::post('/deleteBook', [BooksController::class, 'deleteBook'])->name('deleteBook');
    Route::post('/deleteBook', [BooksController::class, 'deleteBook'])->name('deleteBook');
    Route::get('/newReleases', [BooksController::class, 'newReleases'])->name('newReleases');
    Route::post('/showBooks', [BooksController::class, 'showBooks'])->name('showBooks');
    Route::get('/popular', [BooksController::class, 'popular'])->name('popular');
    
    // Borrowers
    Route::get('/getLostBooksFromArchive', [BorrowsController::class, 'getLostBooksFromArchive'])->name('getLostBooksFromArchive');
    Route::post('/updateStatusWhenLost', [BorrowsController::class, 'updateStatusWhenLost'])->name('updateStatusWhenLost');
    Route::get('/getReturnedBooks', [BorrowsController::class, 'getReturnedBooks'])->name('getReturnedBooks');
    Route::get('/archive', [BorrowsController::class, 'archive'])->name('archive');
    Route::post('/deleteBorrow', [BorrowsController::class, 'deleteBorrow'])->name('deleteBorrow');
    Route::post('/updateBorrow', [BorrowsController::class, 'updateBorrow'])->name('updateBorrow');
    Route::post('/sendToArchive', [BorrowsController::class, 'sendToArchive'])->name('sendToArchive');
    Route::post('/archiveLost', [BorrowsController::class, 'archiveLost'])->name('archiveLost');
    Route::post('/getBorrowDetails', [BorrowsController::class, 'getBorrowDetails'])->name('getBorrowDetails');
    Route::post('/cancelBorrow', [BorrowsController::class, 'cancelBorrow'])->name('cancelBorrow');
    Route::post('/getBookDetails', [BorrowsController::class, 'getBookDetails'])->name('getBookDetails');
    Route::post('/updateLost', [BorrowsController::class, 'updateLost'])->name('updateLost');
    
    // get Totals
    Route::get('/getBooks', [RouteController::class, 'countBooks'])->name('getBooks');
    Route::get('/getUsers', [RouteController::class, 'countUsers'])->name('getUsers');
    Route::get('/getTransactions', [RouteController::class, 'countTransactions'])->name('getTransactions');
    Route::get('/runTime', [RouteController::class, 'getRunningTime'])->name('runTime');

    // profile
    Route::post('/getOne', [UserController::class, 'getOne'])->name('getOne');
    Route::post('/profileUpdate', [UserController::class, 'profileUpdate'])->name('profileUpdate');
    Route::post('/checkPassword', [UserController::class, 'checkPassword'])->name('checkPassword');
    Route::post('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/updateImage', [UserController::class, 'updateImage'])->name('updateImage');
    
    