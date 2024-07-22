<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index() {
        return view('index');
    }
    public function login() {
        return view('login');
    }  
    public function authenticate(Request $request) {
        $username = $request->input('username'); 
        $password = $request->input('password'); 
        
        $students = DB::select("SELECT * FROM accounts WHERE username = '$username' AND password = '$password'");
        if ($students > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login Successful',
                'userID' => $students[0]->userID,
                'userType' => $students[0]->userType
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid username or password',
            ]);        
        }  
    }

    // Admin pages
    public function adminIndex(){ return view('admin.index');}
    public function adminBooks(){ return view('admin.books');}
    public function adminBorrowers(){ return view('admin.borrowers');}
    public function adminProfile(){ return view('admin.myprofile');}
    public function adminUsers(){ return view('admin.users');}

    // Librarian pages
    public function librarianIndex(){return view('librarian.index');}
    public function librarianBooks(){ return view('librarian.books');}
    public function librarianBorrowers(){ return view('librarian.borrowers');}
    public function librarianProfile(){ return view('librarian.myprofile');}
    public function librarianUsers(){ return view('librarian.users');}

    // Patron routing
    public function patronIndex(){return view('user.index');}
    public function patronSchedules(){return view('user.schedules');}
    public function patronLibrary(){return view('user.library');}
    public function patronSearch(){return view('user.search');}
    public function patronProfile(){return view('user.profile');}
    public function countBooks(){
        $count = DB::table('books')->count();
        if ($count > 0) {
            $response = ['count' => $count];
            return response()->json($response);
        } else {
            return response()->json(['error' => 'No results']);
        }
    }
    public function countUsers(){
        $count = DB::table('accounts')->count();
        if ($count > 0) {
            $response = ['count' => $count];
            return response()->json($response);
        } else {
            return response()->json(['error' => 'No results']);
        }
    }
    public function countTransactions(){
        $count = DB::table('borrowdetails')->count();
        if ($count > 0) {
            $response = ['count' => $count];
            return response()->json($response);
        } else {
            $response = ['count' => 0];
            return response()->json($response);
        }
    }
    public function getRunningTime()
    {
        date_default_timezone_set('Asia/Manila');
        $runningTime = date('h:i:s A');
        
        return response()->json(['runningTime' => $runningTime]);
    }
}
