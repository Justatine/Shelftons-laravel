<!doctype html>
<html lang="en">
  <head>
  	<title>Borrowers | Shelftons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <script>
        $(document).ready(function () {
            $('#borrowertable').DataTable({
                "order": [[6, 'desc']]
            });
        });
    </script>


    <script src="../js/borrowers-functions.js"></script>
    <script src="../js/cookies.js"></script>
    <script src="../js/login/login-admin.js"></script>
    
    <style>
        /* .active{
            background-color: blue;
        } */
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
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="#"><button class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg" title="Add user"><i class="fa fa-plus" style="font-size: 20px;"></i></button></a>
                  </li> -->
                  <!-- <li class="nav-item">
                    <input placeholder="Searth for books, author..." type="text" id="myInput" onkeyup="filterTable()" name="text" class="input">
                  </li> -->
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#"  data-toggle="modal" data-target="#returnModal" title="Returned records">Returns</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#" data-toggle="modal" data-target="#lostbooksModal" title="Lost books">Losts</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          
        <!-- edit borrow record -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit borrow</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="edit-form">
                  <div class="row">
                    <div class="col-sm-4">
                      <label for="fname">Borrow ID:</label>
                      <input type="number" id="mborrowID" name="borrowID" class="form-control" readonly>              
                    </div>

                    <div class="col-sm-4">
                      <label for="fname">User ID:</label>
                      <input type="number" id="muserID" name="userID" class="form-control" readonly >
                    </div>

                    <div class="col-sm-4">
                      <label for="fname">ISBN:</label>
                      <input type="text" id="mISBN" name="ISBN" class="form-control" readonly>
                    </div>
                  </div>      

                  <label for="fname">Date borrowed:</label>
                  <input type="datetime" id="mborrowDate" name="borrowDate" class="form-control">

                  <label for="fname">Return schedule:</label>
                  <input type="date" id="mreturnSchedule" name="returnSchedule" class="form-control">

                  <label for="fname">Date returned:</label>
                  <input type="datetime-local" id="mreturnDate" name="returnDate" class="form-control">

                  <label for="fname">Borrow status:</label>
                  <select name="borrowStatus" id="mborrowStatus" class="form-control">
                    <option name="borrowStatus" id="mborrowStatus"  value="Pending">Pending</option>
                    <option name="borrowStatus" id="mborrowStatus"  value="Approved">Approved</option>
                    <option name="borrowStatus" id="mborrowStatus"  value="Overdue">Overdue</option>
                    <option name="borrowStatus" id="mborrowStatus"  value="Cancelled">Cancelled</option>
                  </select>

                  <label for="fname">Return status:</label>
                  <select name="returnStatus" id="mreturnStatus" class="form-control">
                    <option value="Returned">Returned</option>
                    <option value="Not returned">Not returned</option>
                  </select>                  

                  <label for="fname">Fine:</label>
                  <input type="number" id="mfine" name="fine" class="form-control" min="0" step="0.01">
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveupdate">Save changes</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Lost book modal -->
        <div class="modal fade" id="lostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Read guidelines for lost books</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Patron must pay the book "Harry Potter and the Sorcerer’s Stone" first in order to borrow another</p>
                  </div>
                  <div class="row">
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> In order to fully utilize the system again, patrons are required to physically visit the library and make payment for any fines incurred.</p>
                  </div>
                  <div class="row">
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Replacement Cost : ₱ 0</p>
                  </div>          
                </div>

              </div>
              <form id="lostForm">
                <div class="modal-footer">
                  <input type="hidden" name="ed_returnStatus" id="ed_returnStatus">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Yes, I lost this book</button>
                </div>        
              </form>
            </div>
          </div>
        </div>
        <!-- Returns -->
        <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Returned records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table table-striped" id="returnedBooks">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>ISBN</th>
                      <th>User ID</th>
                      <th>Date Borrowed</th>
                      <th>Date Returned</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>  
        <!-- Lost -->
        <div class="modal fade" id="lostbooksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lost Books</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table table-striped" id="lostBooks">
                  <thead class="thead-dark">
                    <tr>
                      <th>Borrow ID</th>
                      <th>ISBN</th>
                      <th>User ID</th>
                      <th>Date Borrowed</th>
                      <th>Return Status</th>
                      <th>Status when lost</th>
                      <th>Fine</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

              <div class="container" style="background-color: white; height: 530px; border-radius: 0.25rem;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);">
                <div class="row">
                  <div class="col-sm-6" style="padding: 5px 5px;">
                    <!-- <input placeholder="Searth for books, author..." type="text" id="myInput" onkeyup="filterTable()" name="text" class="input"> -->
                  </div>
                  <div class="col-sm-6" style=" padding: 5px 5px; text-align: right;">
                    <!-- <a href="#"><button class="btn btn-info" data-toggle="modal" data-target="#returnModal" title="Returned records"><i class="fa fa-book" style="font-size: 20px;"></i> Returned Records</button></a>
                    <a href="#"><button class="btn btn-secondary" data-toggle="modal" data-target="#lostbooksModal" title="Lost books"><i class="fa fa-book" style="font-size: 20px;"></i> Lost Books</button></a>-->
                  </div>
                </div>
                <div class="row p-md-4">
                  <div class="table-responsive" style="overflow: auto; height: 450px; width: 1100px;">
                    <table id="borrowertable" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>User ID</th>
                              <th>ISBN</th>
                              <th>Date Borrowed</th>
                              <th>Return Schedule</th>
                              <th>Return Date</th>
                              <th>Borrow Status</th>
                              <th>Return Status</th>
                              <th>Fine</th>
                              <th>Update</th>
                              <th>Delete</th>
                              <th>Archive</th>
                              <th>Lost</th>
                          </tr>
                      </thead>
                      <tbody> 
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>ID #</th>
                            <th>User ID</th>
                            <th>ISBN</th>
                            <th>Date Borrowed</th>
                            <th>Return Schedule</th>
                            <th>Return Date</th>
                            <th>Borrow Status</th>
                            <th>Return Status</th>
                            <th>Fine</th>
                            <th>Update</th>
                            <th>Delete</th>
                            <th>Archive</th>
                            <th>Lost</th>
                          </tr>
                      </tfoot>
                    </table>
                  </div>                  
                </div>
            </div>
      </div>
    </div>

    <!-- LOST BOOKS MODAL -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <img src="../images/icon1.png" alt="" style="height: 50px; width: 50px;">List of Lost books
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container" style=" background-color: rgba(244, 235, 222, 0.5); border-radius: 10px;">
            
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
    
    <div id="preloader"></div>
    
    <script src="../js/js.js"></script> 
    {{-- {{-- <script src="js/jquery.min.js"></script> --}}
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>  
    <script src="js/main.js"></script>
  </body>
</html>