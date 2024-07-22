<!doctype html>
<html lang="en">
  <head>
  	<title>Users | Shelftons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/librarian/css/style.css">
    <link rel="icon" type="image/x-icon" href="../images/icon1.png">

    <!-- Loader -->
    <link rel="stylesheet" href="../css/preloader.css">
    <script src="../js/preloader.js"></script>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--data tables-->  
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <script>
        $(document).ready(function () {
            $('#userstable').DataTable();
        });
    </script>  
    <script src="../js/user-functions.js"></script>

    <script src="../js/cookies.js"></script>
    <script src="../js/login/login-librarian.js"></script>
    <style>
      .scrollable-tbody {
        height: 200px;
        overflow-y: scroll;
      }
    </style>
  </head>
  <body style="background-image: url('../images/b7.jpg');  background-repeat: no-repeat; background-size: cover;">
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" style="z-index: 99; background-color: #dbb077;">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary" style="border: 1px solid white; background-color: #dbb077;">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
                    <h1 style="font-size: 40px;"><a href="index.html" class="logo"><img src="../images/icon1.png" alt="" style="margin-left: 25%"> Shelftons</a></h1>
                <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ route('librarian.index') }}"><span class="fa fa-home mr-3"></span> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('librarian.users') }}"><span class="fa fa-user mr-3"></span> Users</a>
                </li>
                <li>
                    <a href="{{ route('librarian.books') }}"><span class="fa fa-book mr-3"></span> Books</a>
                </li>
                <li>
                  <a href="{{ route('librarian.borrowers') }}"><span class="fa fa-address-book-o mr-3"></span> Borrowers</a>
                </li>
                <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user-circle-o mr-3"></span> Account</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="{{ route('librarian.myprofile') }}">Profile</a>
                </li>
                </ul>   
                </li>
                <li>
                  <a href="#" data-toggle="modal" data-target=".bd-example-modal-sm"><span class="fa fa-sign-out mr-3" aria-hidden="true"></span>Signout</a>
                </li>
	        </ul>

	        <div class="mb-5">
						<h3 class="h6">Subscribe for newsletter</h3>
						<form action="#" class="colorlib-subscribe-form">
	            <div class="form-group d-flex">
	            	<div class="icon"><span class="icon-paper-plane"></span></div>
	              <input type="text" class="form-control" placeholder="Enter Email Address">
	            </div>
	          </form>
					</div>

	        <div class="footer">
				<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a> -->
	        </div>
	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 1;">
            <div class="container-fluid">
              <h2 id="sidebarCollapse" > Hi, welcome user
                <span class="sr-only"></span>
              </h2>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#" data-toggle="modal" data-target=".bd-example-modal-lg" title="Add user">Add new user</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Activity</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
              <div class="container" style="background-color: white; height: 530px; border-radius: 0.25rem;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);">
                <div class="row">
                  <div class="col-sm-8" style="padding: 5px 5px;">
                    <!-- <input placeholder="Searth for id, names..." type="text" id="myInput" onkeyup="filterTable()" name="text" class="input"> -->
                  </div>
                  <div class="col-sm-4" style="padding: 5px 5px; text-align: right;">
                    <!-- <a href="#"><button class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg" title="Add user"><i class="fa fa-user-plus" style="font-size: 20px;"></i></button></a> -->
                  </div>
                </div>
                <div class="row p-md-4">
                  <div id="usertablecontainer" style="overflow: auto; height: 450px; width: 1100px;">
                    <table id="userstable" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>ID #</th>
                              <th>Profile</th>
                              <th>Firstname</th>
                              <th>Middlename</th>
                              <th>Lastname</th>
                              <th>Gender</th>
                              <th>Birthdate</th>
                              <th>Email</th>
                              <th>Phone No.</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>Province</th>
                              <th>Zipcode</th>
                              <th>Role</th>
                          </tr>
                      </thead>
                      <tbody> 
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>ID #</th>
                            <th>Profile</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Current Address</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Zipcode</th>
                            <th>Role</th>
                          </tr>
                      </tfoot>
                  </table>                     
                  </div>
                </div>
            </div>
      </div>
    </div>
    <!-- VIEW SINGLE USER MODAL -->
    <div class="modal fade" id="singleuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>    
    <!-- EDIT USER MODAL -->
    <div class="modal fade" id="editusermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit user account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="edit-form">
              @csrf
              <div class="container"  style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="row">
                  <div class="col-sm-2">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="fname">Pic:</label>
                          <input type="file" name="newuserimg" class="form-control">                    
                        </div>                        
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="fname">Username:</label>
                        <input type="text" id="eusername" name="eusername" class="form-control">
                      </div>
                    </div><br> 
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="fname">Password:</label>
                        <input type="password" id="epassword" name="epassword" class="form-control">
                        <input type="checkbox" id="showPasswordCheckbox" name="showPasswordCheckbox">
                        <label for="showPasswordCheckbox">Show Password</label>
                      </div>
                    </div>                  
                  </div>
                  <div class="col-sm-10">              
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="hidden" id="eid" name="eid">
                        <label for="fname">First Name:</label>
                        <input type="text" id="efname" name="efname" class="form-control">
                      </div>
                      <div class="col-sm-4">
                        <label for="mname">Middle Name:</label>
                        <input type="text" id="emname" name="emname" class="form-control">                        
                      </div>
                      <div class="col-sm-4">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="elname" name="elname" class="form-control">                       
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col-sm-3">
                        <label for="fname">Gender:</label>
                        <select name="egender" id="egender" disabled class="form-control">
                          <option disabled>Choose your gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>                       
                      </div>
                      <div class="col-sm-3">
                        <label for="fname">Date of birth:</label>
                        <input type="date" id="ebirthdate" name="ebirthdate" disabled class="form-control">                       
                      </div>
                      <div class="col-sm-3">
                        <label for="fname">Email:</label>
                        <input type="text" id="eemail" name="eemail" class="form-control">                        
                      </div>
                      <div class="col-sm-3">
                        <label for="fname">Phone Number:</label>
                        <input type="text" id="ephoneNo" name="ephoneNo" class="form-control">                       
                      </div>
                    </div><hr>
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="fname">Current address:</label>
                        <input type="text" id="ecurrent_address" name="ecurrent_address" class="form-control">                       
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="fname">City:</label>
                        <input type="text" id="ecity" name="ecity" class="form-control">
                      </div>
                      <div class="col-sm-4">
                        <label for="fname">Province:</label>
                        <input type="text" id="eprovince" name="eprovince" class="form-control">                       
                      </div>
                      <div class="col-sm-4">
                        <label for="fname">Zipcode:</label>
                        <input type="text" id="ezipcode" name="ezipcode" class="form-control">                       
                      </div>
                    </div>
                  </div>
                </div><hr>
                <div class="row" style="text-align: right;">
                  <div class="col-sm-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary newuser" name="newuser" id="newuser">Update information</button>
                  </div>
                </div><br>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <div id="preloader"></div>

    <!-- REGISTRATION MODAL -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <img src="../images/icon1.png" alt="" style="height: 50px; width: 50px;">Add a user
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
              <form id="myForm" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-2">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="fname">Profile image:</label>
                          <input type="file" name="userimg" class="form-control-file"><br>                        
                        </div>                             
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="fname">Username:</label>
                        <input type="text" id="username" name="username" class="form-control">                        
                      </div><br>
                      <div class="col-sm-12">
                        <label for="fname">Password:</label>
                        <input type="text" id="password" name="password" class="form-control">                        
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" class="form-control">                        
                      </div>
                      <div class="col-sm-4">
                        <label for="mname">Middle Name:</label>
                        <input type="text" id="mname" name="mname" class="form-control">                        
                      </div>
                      <div class="col-sm-4">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" class="form-control"><br>                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <label for="fname">Gender:</label>
                        <select name="gender" id="gender" class="form-control">
                          <option disabled selected >Choose your gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="fname">Date of birth:</label>
                        <input type="date" id="birthdate" name="birthdate" class="form-control">                        
                      </div>
                      <div class="col-sm-3">
                        <label for="fname">Email:</label>
                        <input type="text" id="email" name="email" class="form-control">                       
                      </div>
                      <div class="col-sm-3">
                        <label for="fname">Phone Number:</label>
                        <input type="text" id="phoneNo" name="phoneNo" class="form-control">
                      </div>
                    </div><hr>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="fname">Current address:</label>
                          <input type="text" id="current_address" name="current_address" class="form-control" placeholder="Street/Purok/Barangay">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="fname">City:</label>
                        <input type="text" id="city" name="city" class="form-control">                        
                      </div>
                      <div class="col-sm-4">
                        <label for="fname">Province:</label>
                        <input type="text" id="province" name="province" class="form-control">                        
                      </div>
                      <div class="col-sm-4">
                        <label for="fname">Zipcode:</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control">                      
                      </div>
                    </div><hr>
                    <div class="row" style="text-align: right;">
                      <div class="col-sm-12">
                        <button type="submit" id="submitBtn" class="btn btn-primary">Save new user</button>                   
                      </div>
                    </div><br>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div> <!--end of add user modal-->
    <!-- Signout Modal -->
    <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <center>
                <i class="fa fa-exclamation-circle" aria-hidden="true" style="font-size: 50px; color: red;"></i>
                <p>Do you want to signout?</p>
            </center>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" id="out" class="btn btn-danger">Signout</button>
          </div>
        </div>
      </div>
    </div>
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>