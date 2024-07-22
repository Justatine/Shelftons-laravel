<?php

namespace App\Http\Controllers;

use App\Models\Useraccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Login
    public function login(Request $request) {
        $username = $request->input('username'); 
        $password = $request->input('password'); 
        
        $students = DB::select("SELECT * FROM accounts WHERE username = '$username' AND password = '$password'");
        if ($students > 0) {
            $id = $students[0]->userID;
            $row = $students;
            return response()->json(['status' => "success", 'message' => 'Login successful', 'userID' => $id, 'userType' => $students[0]->userType], 200);

        } else {
            return response()->json(['status' => "fail", 'data' => 'No user data found'], 404);
        }  
    }
    // Register
    public function register(Request $request)
    {
    //     date_default_timezone_set('Asia/Manila');
    //     $id = date('ymdhis');
        $fn = $request->input('fname');
        $mn = $request->input('mname');
        if ($mn == '') {
            $mn = ' ';
        }
        $ln = $request->input('lname');
        $gender = $request->input('gender');
        $dob = $request->input('birthdate');
        $em = $request->input('email');
        $phn = $request->input('phoneNo');
        $ca = $request->input('current_address');
        $city = $request->input('city');
        $prov = $request->input('province');
        $zip = $request->input('zipcode');
        $un = $request->input('username');
        $pwd = $request->input('password');
        $ut = "Patron";
    
        $userimg = $request->file('userimg');
    
        // Set default filename if no file input
        $userimgName = $userimg ? time() . '-' . $userimg->getClientOriginalName() : 'default.png';
    
        $target_dir = "uploads/";
        $target_file = $target_dir . $userimgName;
    
        $queryc = DB::table('accounts')->where('username', $un)->orWhere('password', $pwd)->get();
    
        if ($queryc->isNotEmpty()) {
            $msg = "Username/password not available";
            return response()->json(['message' => $msg, 'messageType' => 'alreadyexist']);
        } else {
            if ($userimg && $userimg->move($target_dir, $userimgName)) {
                DB::table('accounts')->insert([
                    // 'userID' => $id,
                    'userImg' => $userimgName,
                    'firstname' => $fn,
                    'middlename' => $mn,
                    'lastname' => $ln,
                    'gender' => $gender,
                    'birthdate' => $dob,
                    'email' => $em,
                    'phoneNo' => $phn,
                    'current_address' => $ca,
                    'city' => $city,
                    'province' => $prov,
                    'zipcode' => $zip,
                    'username' => $un,
                    'password' => $pwd,
                    'userType' => $ut,
                ]);
    
                $msg = "Registration successful!";
                return response()->json(['message' => $msg, 'messageType' => 'success']);
            } else {
                return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
            }
        }
    }
    // View Users
    public function getUsers(){
        $users = DB::select('SELECT * FROM accounts');
        return response()->json(['status' => "success", 'data' => $users]);
    }
    // View single voter
    public function getOne(Request $request){
        $id = $request->input('id');
        $user = DB::select("SELECT * FROM accounts WHERE accounts.userID = {$id}");

        if (!empty($user)) {
            return response()->json(['status' => "success", 'data' => $user], 200);
        } else {
            return response()->json(['status' => "fail", 'data' => "No author with an ID of {$id} found"], 404);
        }
    }
    // Change user image
    public function changePic(Request $request){
        $id = $request->input('eid');
        $newuserimgName = $request->file('newuserimg');
        
        $empty = true;
        if ($request->hasFile('newuserimg') && $request->file('newuserimg')->isValid()) {
            $empty = false;
        }
        
        $user = DB::table('user')->where('userID', $id)->first();
        $imageFilename = $user->userImg ?? null;

        if (!$empty) {
            if (!empty($imageFilename)) {
                $imagePath = "uploads/" . $imageFilename;
                if (file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        return response()->json([
                            'messageType' => 'success',
                            'message' => 'Image updated successfully.'
                        ]);
                    } else {
                        return response()->json([
                            'messageType' => 'failed',
                            'message' => 'Failed to update image'
                        ]);
                    }
                }
            }

            $newuserimgName = time() . '-' . $request->file('newuserimg')->getClientOriginalName();
            $targetPath = "uploads/";
            $request->file('newuserimg')->move($targetPath, $newuserimgName);

            $update = DB::table('user')->where('userID', $id)->update(['userImg' => $newuserimgName]);
            if ($update) {
                return response()->json([
                    'messageType' => 'success',
                    'message' => 'User updated successfully.'
                ]);
            } else {
                return response()->json([
                    'messageType' => 'failed',
                    'message' => 'Failed to delete user'
                ]);
            }
        }
    }
    // Create user
    public function createUser(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        // $id = date('ymdhis');
        $fn = $request->input('fname');
        $mn = $request->input('mname');
        if ($mn == '' || empty($mn)) {
            $mn = ' ';
        }
        $ln = $request->input('lname');
        $gender = $request->input('gender');
        $dob = $request->input('birthdate');
        $em = $request->input('email');
        $phn = $request->input('phoneNo');
        $ca = $request->input('current_address');
        $city = $request->input('city');
        $prov = $request->input('province');
        $zip = $request->input('zipcode');
        $un = $request->input('username');
        $pwd = $request->input('password');
        $ut = "Patron";
    
        // Handle file upload
        $userImgName = "default.png"; // default value
    
        if ($request->hasFile('userimg')) {
            $userImgName = time() . '-' . $request->file('userimg')->getClientOriginalName();
            $request->file('userimg')->storeAs('uploads', $userImgName);
        }
    
        // Save to the database
        $res = DB::table('accounts')->insert([
            'userImg' => $userImgName,
            'firstname' => $fn,
            'middlename' => $mn,
            'lastname' => $ln,
            'gender' => $gender,
            'birthdate' => $dob,
            'email' => $em,
            'phoneNo' => $phn,
            'current_address' => $ca,
            'city' => $city,
            'province' => $prov,
            'zipcode' => $zip,
            'username' => $un,
            'password' => $pwd,
            'userType' => $ut
        ]);
    
        if ($res) {
            $msg = "Added Successfully";
            return response()->json(['message' => $msg, 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }    
    public function createLibrarian(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        // $id = date('ymdhis');
        $fn = $request->input('fname');
        $mn = $request->input('mname');
        if ($mn == '') {
            $mn = ' ';
        }        
        $ln = $request->input('lname');
        $gender = $request->input('gender');
        $dob = $request->input('birthdate');
        $em = $request->input('email');
        $phn = $request->input('phoneNo');
        $ca = $request->input('current_address');
        $city = $request->input('city');
        $prov = $request->input('province');
        $zip = $request->input('zipcode');
        $un = $request->input('username');
        $pwd = $request->input('password');
        $ut = "Librarian";
    
        // Handle file upload
        // $userImgName = "default.png"; // default value
    
        // if ($request->hasFile('userimg')) {
        //     $userImgName = time() . '-' . $request->file('userimg')->getClientOriginalName();
        //     $request->file('userimg')->storeAs('uploads', $userImgName);
        // }
        $userimg = $request->file('userimg');
    
        // Set default filename if no file input
        $userImgName = $userimg ? time() . '-' . $userimg->getClientOriginalName() : 'default.png';
    
        $target_dir = "uploads/";
        $userimg && $userimg->move($target_dir, $userImgName);
        // Save to the database using insertOrIgnore
        $res = DB::table('accounts')->insertOrIgnore([
            'userImg' => $userImgName,
            'firstname' => $fn,
            'middlename' => $mn,
            'lastname' => $ln,
            'gender' => $gender,
            'birthdate' => $dob,
            'email' => $em,
            'phoneNo' => $phn,
            'current_address' => $ca,
            'city' => $city,
            'province' => $prov,
            'zipcode' => $zip,
            'username' => $un,
            'password' => $pwd,
            'userType' => $ut
        ]);
    
        if ($res) {
            $msg = "Librarian created successfully";
            return response()->json(['message' => $msg, 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }   
    public function createAdmin(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        // $id = date('ymdhis');
        $fn = $request->input('fname');
        $mn = $request->input('mname');
        if ($mn == '') {
            $mn = ' ';
        }
        $ln = $request->input('lname');
        $gender = $request->input('gender');
        $dob = $request->input('birthdate');
        $em = $request->input('email');
        $phn = $request->input('phoneNo');
        $ca = $request->input('current_address');
        $city = $request->input('city');
        $prov = $request->input('province');
        $zip = $request->input('zipcode');
        $un = $request->input('username');
        $pwd = $request->input('password');
        $ut = "Admin";
    
        // Handle file upload
        $userImgName = "default.png"; // default value
    
        if ($request->hasFile('userimg')) {
            $userImgName = time() . '-' . $request->file('userimg')->getClientOriginalName();
            $request->file('userimg')->storeAs('uploads', $userImgName);
        }
    
        // Save to the database using insertOrIgnore
        $res = DB::table('accounts')->insertOrIgnore([
            'userImg' => $userImgName,
            'firstname' => $fn,
            'middlename' => $mn,
            'lastname' => $ln,
            'gender' => $gender,
            'birthdate' => $dob,
            'email' => $em,
            'phoneNo' => $phn,
            'current_address' => $ca,
            'city' => $city,
            'province' => $prov,
            'zipcode' => $zip,
            'username' => $un,
            'password' => $pwd,
            'userType' => $ut
        ]);
    
        if ($res) {
            $msg = "Librarian created successfully";
            return response()->json(['message' => $msg, 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'Failed', 'messageType' => 'failed']);
        }
    }   
    // Update user
    public function updateUser(Request $request){
        $id = $request->input('eid');
        $fname = $request->input('efname');
        $mn = $request->input('emname');
        if ($mn == '' || empty($mn)) {
            $mn = ' ';
        }
        $ln = $request->input('elname');
        $em = $request->input('eemail');
        $phn = $request->input('ephoneNo');
        $ca = $request->input('ecurrent_address');
        $city = $request->input('ecity');
        $prov = $request->input('eprovince');
        $zip = $request->input('ezipcode');
        $un = $request->input('eusername');
        $pwd = $request->input('epassword');
        $newuserimg = $request->file('newuserimg');

        $empty = 'true';
        if ($newuserimg !== null) {
            $empty = 'false';
        }

        $imageFilename = DB::table('accounts')->where('userID', $id)->value('userImg');

        if ($empty == 'false') {
            if (!empty($imageFilename)) {
                $imagePath = public_path("uploads/$imageFilename");
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $newFileName = time() . '-' . $newuserimg->getClientOriginalName();
            $newuserimg->move(public_path('uploads'), $newFileName);

            DB::table('accounts')
                ->where('userID', $id)
                ->update([
                    'userImg' => $newFileName,
                    'firstname' => $fname,
                    'middlename' => $mn,
                    'lastname' => $ln,
                    'email' => $em,
                    'phoneNo' => $phn,
                    'current_address' => $ca,
                    'city' => $city,
                    'province' => $prov,
                    'zipcode' => $zip,
                    'username' => $un,
                    'password' => $pwd
                ]);

            $response = [
                'messageType' => 'success',
                'message' => 'User updated successfully.'
            ];
        } else {
            DB::table('accounts')
                ->where('userID', $id)
                ->update([
                    'firstname' => $fname,
                    'middlename' => $mn,
                    'lastname' => $ln,
                    'email' => $em,
                    'phoneNo' => $phn,
                    'current_address' => $ca,
                    'city' => $city,
                    'province' => $prov,
                    'zipcode' => $zip,
                    'username' => $un,
                    'password' => $pwd
                ]);

            $response = [
                'messageType' => 'success',
                'message' => 'User updated successfully.'
            ];
        }
        return response()->json($response);
    }
    // Delete user
    public function deleteUser(Request $request){
        $id = $request->input('id');
    
        $user = DB::table('accounts')->where('userID', $id)->first();
    
        if ($user) {
            // Check if the user has related entries in the borrowdetails table
            $hasBorrowDetails = DB::table('borrowdetails')->where('userID', $id)->exists();
    
            if ($hasBorrowDetails) {
                // If there are related entries, delete them first
                DB::table('borrowdetails')->where('userID', $id)->delete();
            }
    
            $imageFilename = $user->userImg;
    
            if (!empty($imageFilename) && $imageFilename !== 'default.png') {
                $imagePath = "uploads/" . $imageFilename;
    
                if (Storage::exists($imagePath)) {
                    if (Storage::delete($imagePath)) {
                        // User deleted successfully along with related borrowdetails
                        DB::table('accounts')->where('userID', $id)->delete();
                        return response()->json(['message' => 'User deleted successfully!', 'messageType' => 'success']);
                    } else {
                        return response()->json(['message' => 'Failed to delete image.', 'messageType' => 'failed']);
                    }
                }
            }
    
            // User has either no image or "default.png", so proceed to delete
            DB::table('accounts')->where('userID', $id)->delete();
            return response()->json(['message' => 'User deleted successfully!', 'messageType' => 'success']);
        } else {
            return response()->json(['message' => 'User not found.', 'messageType' => 'failed']);
        }
    }    
    // Lost records per user
    public function lostBlock(){
        $lostBooks = DB::table('archive')
            ->select('bookStatus', 'userID', 'status_when_lost')
            ->where('bookStatus', 'Lost')
            ->where('status_when_lost', 'Unpaid')
            ->get();

        if ($lostBooks->isNotEmpty()) {
            $students = $lostBooks->toArray();
            return response()->json(['status' => "success", 'data' => $students]);
        } else {
            return response()->json(['status' => "failed", 'data' => '0']);
        }
    }
    // Profile update
    public function profileUpdate(Request $request)
    {
        $id = $request->input('eid');
        $fname = $request->input('efname');
        $mn = $request->input('emname');
        $ln = $request->input('elname');
        $em = $request->input('eemail');
        $phn = $request->input('ephoneNo');
        $ca = $request->input('ecurrent_address');
        $city = $request->input('ecity');
        $prov = $request->input('eprovince');
        $zip = $request->input('ezipcode');
        $un = $request->input('eusername');

        try {
            DB::table('accounts')
                ->where('userID', $id)
                ->update([
                    'firstname' => $fname,
                    'middlename' => $mn,
                    'lastname' => $ln,
                    'email' => $em,
                    'phoneNo' => $phn,
                    'current_address' => $ca,
                    'city' => $city,
                    'province' => $prov,
                    'zipcode' => $zip,
                    'username' => $un,
                ]);

            $response = [
                'messageType' => 'success',
                'message' => 'User updated successfully.'
            ];
        } catch (\Exception $e) {
            $response = [
                'messageType' => 'failed',
                'message' => 'Failed to update user.'
            ];
        }
        return response()->json($response);
    }
    public function checkPassword(Request $request)
    {
        $id = $request->input('id');
        $pwd = $request->input('passid');

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'passid' => [
                'required',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/m',
            ],
        ]);

        if ($validator->fails()) {
            $response = [
                'messageType' => 'failed',
                'message' => 'Password is not valid.',
            ];
        } else {
            $response = [
                'messageType' => 'success',
                'message' => 'Password is valid.',
            ];
        }

        return response()->json($response);
    }
    // Change password
    public function changePassword(Request $request){
        $id = $request->input('id');
        $pwd = $request->input('passid');

        $affected = DB::table('accounts')
            ->where('userID', $id)
            ->update(['password' => $pwd]);

        if ($affected) {
            return response()->json(['status' => "success", 'message' => 'Password updated'], 200);
        } else {
            return response()->json(['status' => "success", 'message' => 'Update failed']);
        }
    }
    public function updateImage(Request $request)
    {
        $id = $request->input('eid');
        $newuserimg = $request->file('newuserimg');

        $empty = true;
        if (!empty($newuserimg)) {
            $empty = false;
        }

        $imageFilename = DB::table('accounts')->where('userID', $id)->value('userImg');

        if (!$empty) {
            if (!empty($imageFilename)) {
                $imagePath = "uploads/" . $imageFilename;
                if (file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        DB::table('accounts')->where('userID', $id)->update(['userImg' => null]);
                        $response = [
                            'messageType' => 'success',
                            'message' => 'Image updated successfully.'
                        ];
                        return response()->json($response);
                    } else {
                        $response = [
                            'messageType' => 'failed',
                            'message' => 'Failed to update image.'
                        ];
                        return response()->json($response);
                    }
                }
            }

            $newuserimgName = time() . '-' . $newuserimg->getClientOriginalName();
            $newuserimg->move('uploads/', $newuserimgName);

            DB::table('accounts')->where('userID', $id)->update(['userImg' => $newuserimgName]);

            $response = [
                'messageType' => 'success',
                'message' => 'User updated successfully.'
            ];

            return response()->json($response);
        }

        $response = [
            'messageType' => 'failed',
            'message' => 'No image uploaded.'
        ];

        return response()->json($response);
    }
    // Authenticate
    // public function checkAuth(Request $request) {
    //     // $res["message"] = "test";
    //     $value = $request->header('X-Header-Name', 'default');
    //     $headerValue = $request->header('Authorization');
    //     if (!$headerValue) {
    //         return response()->json([
    //             'message' => 'Unauthorized: No authorization.'
    //         ], 401);
    //     }
    //     $authorizationParts = explode(" ", $headerValue);
    //     if (count($authorizationParts) !== 2) {
    //         return response()->json([
    //             'message' => 'Unauthorized: Invalid authorization format.'
    //         ], 401);
    //     }
    //     list($type, $token) = $authorizationParts;
    //     if ($type !== "Bearer") {
    //         return response()->json([
    //             'message' => 'Unauthorized: Invalid authorization type.'
    //         ], 401);
    //     }
    //     if ($token === NULL) {
    //         return response()->json([
    //             'message' => 'Unauthorized: No token.'
    //         ], 401);
    //     }
    //     $voters = DB::table('patrons')->where('token', $token)->first();
    //     if ($voters) {
    //         return response()->json(true, 200);
    //     } else {
    //         return response()->json(['message' => 'Unauthorized: Token does not exist.'], 401);
    //     }
    // }
    // Check duplicate for username and pass
    // private function checkDuplicateAuthors($isbn, $author){
    //     $count = DB::table('authors')
    //         ->where('ISBN', $isbn)
    //         ->where('author_fullname', $author)
    //         ->count();
    //     return $count === 0; 
    // }
}