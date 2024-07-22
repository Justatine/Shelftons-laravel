<!doctype html>
<html lang="en">
  <head>
  	<title>Admin Panel | Shelftons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/admin/css/style.css">

    <!-- Loader -->
    <link rel="stylesheet" href="../css/preloader.css">
    <script src="../js/preloader.js"></script>

    <link rel="icon" type="image/x-icon" href="../images/icon1.png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--data tables-->  
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

    <script src="../js/dashboard.js"></script>
    <script src="../js/cookies.js"></script>
    <script src="../js/login/login-admin.js"></script>
    
    <script src="../js/book-functions.js"></script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@900&display=swap');
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
                    <a href="{{ route('admin.index') }}"><span class="fa fa-home mr-3"></span> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}"><span class="fa fa-user mr-3"></span> Users</a>
                </li>
                <li>
                    <a href="{{ route('admin.books') }}"><span class="fa fa-book mr-3"></span> Books</a>
                </li>
                <li>
                  <a href="{{ route('admin.borrowers') }}"><span class="fa fa-address-book-o mr-3"></span> Borrowers</a>
                </li>
                <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user-circle-o mr-3"></span> Account</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="{{ route('admin.myprofile') }}">Profile</a>
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
              <h2 id="sidebarCollapse" > Hi, welcome Admin
                <span class="sr-only"></span>
              </h2>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">About</a>
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
          <div class="row">
            <div class="col-sm-7">
              <div style="display:inline-block; ">

              <!--card 1-->   
                <div class="card" style="display:inline-block;">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <div class="row">
                      <div class="col-sm-6" style="padding: 10px 10px 10px 10px;">
                        <div class="container" >
                          <center>
                            <div id="numberofusers"></div>
                          </center>
                        </div>
                      </div>
                      <div class="col-sm-6"  >
                        <div class="container" style="padding: 10px 10px 10px 10px;">    
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">Number of Users</h6>    
                        <p class="card-text">
                          The page is dedicated to user management, allowing administrators to seamlessly add, edit, and delete user accounts.
                        </p>
                      </div>
                    </div>
                    <center>
                      <a href="#" class="card-link" data-toggle="modal" data-target=".bd-example-modal-lg" title="Add user">Add new user</a> 
                      <a href="{{ route('admin.users') }}" class="card-link">View users</a>                      
                    </center>
                  </div>
              </div>   

              <!--card 2-->   
              <div class="card" style="display:inline-block;">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <div class="row">
                      <div class="col-sm-6" style="padding: 10px 10px 10px 10px;">
                        <div class="container" >
                          <center>
                            <div id="numberofbooks"></div>
                          </center>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="container" style="padding: 10px 10px 10px 10px;">
                          
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">Number of Books</h6>    
                        <p class="card-text">
                          The page is dedicated to managing library books, allowing administrators to add, edit, and delete books available for users to borrow.
                        </p>
                      </div>
                    </div>
                    <center>
                      <a href="#" class="card-link" data-toggle="modal" data-target="#newbook" title="Add book">Add new book</a> 
                      <a href="{{ route('admin.books') }}" class="card-link">View books</a>                      
                    </center>
                  </div>
              </div>

              <!--card 3-->   
              <div class="card" style="display:inline-block;">
                <div class="card-body">
                  <!-- <h5 class="card-title">Card title</h5> -->
                  <div class="row">
                    <div class="col-sm-6" style="padding: 10px 10px 10px 10px;">
                      <div class="container" >
                        <center>
                          <div id="numberofborrows"></div>
                        </center>
                      </div>
                    </div>
                    <div class="col-sm-6" >
                      <div class="container" style="padding: 10px 10px 10px 10px;">
                        
                      </div>
                      <h6 class="card-subtitle mb-2 text-muted">Number of Transactions</h6>    
                      <p class="card-text">
                        The page facilitates book borrowing transactions, empowering administrators to review, permit, and approve user requests for borrowing books.
                      </p>
                    </div>
                  </div>
                  <center>
                    <a href="{{ route('admin.borrowers') }}" class="card-link">Manage borrow transactions</a>
                  </center>
                </div>
            </div>       
              </div>
            </div>
            <div class="col-sm-5">
                <!--card 4-->   
                <div class="card" style="width: 100%;">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <div class="row">
                      <div class="col-sm-12" style="padding: 10px 10px 10px 10px;">
                        <div class="container">
                          <br>                
                          <center>
                            <i class="fa fa-clock-o" style="font-size:150px"></i><br><br>
                            <h3><strong>Today is: </strong><span id="day"></span></h3><hr>
                            <h3><strong>Date: </strong><span id="currentDate"></span></h3><hr>
                            <h3><strong>Time:</strong> <span id="runningTime"></span></h3>
                          </center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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

    <!-- ADD BOOK MODAL -->
    <div class="modal fade bd-example-modal-lg " id="newbook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <img src="../images/icon1.png" alt="" style="height: 50px; width: 50px;">Add new book
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <form action=""  enctype="multipart/form-data" id="myFormaddbook">
                <div class="row">
                  <div class="col-sm-5" style=" padding: 0 10px 10px 10px;">
                    <h3 style="background-color: rgba(136, 86, 59, 0.5);text-align: center;text-transform: uppercase;padding: 10px 10px 10px 10px;font-family: 'Roboto Slab', serif;">BOOK</h3>                         
                    <div class="row" >
                          <div class="col-sm-12">
                              <strong><label for="" class="col-form-label-sm">ISBN:</label></strong>
                              <input type="text" id="ISBN" name="ISBN" class="form-control" required>
                            </div>
                          <div class="col-sm-12">
                              <strong><label for="" class="col-form-label-sm">Book Cover:</label></strong>
                              <input type="file" name="bookImg" id="bookImg" class="form-control-file" required>
                            </div>
                          <div class="col-sm-12">
                              <strong><label for="" class="col-form-label-sm">Title:</label></strong>
                              <input type="text" id="bookTitle" name="bookTitle" class="form-control" required>
                            </div> 
                          <div class="col-sm-12">
                              <strong><label for="" class="col-form-label-sm" >Description:</label></strong>
                              <textarea name="bookDesc" id="bookDesc" cols="30" rows="10" class="form-control"></textarea>
                            </div> 
                      </div><!--row-1--> <br>
                      <div class="row">
                          <div class="col-sm-6">
                              <strong><label for="" class="col-form-label-sm">Category:</label></strong>
                              <input type="text" name="bookCat"  id="bookCat" class="form-control">
                          </div>
                          <div class="col-sm-6">
                              <strong><label for="" class="col-form-label-sm" >Existing categories:</label></strong>
                              <select name="bookCat" id="bookCatss" class="form-control">
                                  <option selected disabled value="">Select categories</option>
                              </select>    
                          </div> 
                      </div><!--row-2--> <br>
                  </div>
                  <div class="col-sm-7"style="border-left: 2px solid white; border-right: 10px solid  rgba(244, 235, 222, 0.5);">
                    <h3 style="background-color: rgba(136, 86, 59, 0.5);text-align: center;text-transform: uppercase;padding: 10px 10px 10px 10px;font-family: 'Roboto Slab', serif;">PUBLISHING</h3>   
                      <div class="row">
                          <div class="col-sm-6">
                              <strong><label for="" class="col-form-label-sm">Publisher:</label></strong>
                              <input type="text" id="publisher" name="publisher" class="form-control">
                            </div>
                          <div class="col-sm-6">
                              <strong><label for="" class="col-form-label-sm">Year Published:</label></strong>
                              <input type="text" id="yearPublished" name="yearPublished" class="form-control">
                            </div> 
                      </div><br>
                      <h3 style="background-color: rgba(136, 86, 59, 0.5);text-align: center;text-transform: uppercase;padding: 10px 10px 10px 10px;font-family: 'Roboto Slab', serif;">AUTHOR</h3>               
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12">
                            <label for="fname"><strong>Author/s:</strong></label><br>
                            <textarea id="author_fullname" name="author_fullname" cols="30" rows="10" class="form-control"></textarea>
                          </div>
                        </div>
                      </div>
                      <!--stocks-->
                      <h3 style="background-color: rgba(136, 86, 59, 0.5);text-align: center;text-transform: uppercase;padding: 10px 10px 10px 10px;font-family: 'Roboto Slab', serif;">stocks</h3>                        
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12">
                            <label for="fname"><strong>Stocks:</strong></label><br>
                            <input type="number" name="stocks" id="" class="form-control" min="0">
                          </div>
                        </div>
                      </div>  
                      <h3 style="background-color: rgba(136, 86, 59, 0.5);text-align: center;text-transform: uppercase;padding: 10px 10px 10px 10px;font-family: 'Roboto Slab', serif;">fines</h3>  
                     <div class="form-group">
                          <div class="row">
                              <div class="col-sm-6">
                                  <strong><label for="" class="col-form-label-sm">Replacement Cost (if lost):</label></strong>
                                  <input type="number" id="replacementCost" name="replacementCost" step="0.01" min="0" class="form-control">
                                </div>        
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add new book</button>
                </div>              
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> 
    
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
    <!-- <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="js/main.js"></script>
  </body>
</html>