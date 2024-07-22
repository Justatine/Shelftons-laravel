<!doctype html>
<html lang="en">
  <head>
  	<title>Books | Shelftons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/admin/css/style.css">
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

    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="../js/book-functions.js"></script>
    <script src="../js/cookies.js"></script>
    <script src="../js/login/login-admin.js"></script>

    <!--data tables-->  
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <script>
        $(document).ready(function () {
            $('#bookstable').DataTable();
        });
    </script>  
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
                      <a class="nav-link" href="#" data-toggle="modal" data-target="#newbook" title="Add book">Add new book</a>
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
              <div class="container" style=" background-color: white; height: 530px; border-radius: 0.25rem;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);">
                <div class="row">
                  <div class="col-sm-6" style="padding: 5px 5px;">
                    <!-- <input placeholder="Searth for books, authors..." type="text" id="myInput" onkeyup="filterTable()" name="text" class="input"> -->
                  </div>
                  <div class="col-sm-6" style=" padding: 5px 5px; text-align: right;">
                    <!-- <a href="#"><button class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg" title="Add user"><i class="fa fa-book" style="font-size: 20px;"></i> Add new book</button></a> -->
                  </div>
                </div>
                <div class="row p-md-4">
                  <div id="bookstablecontainer" style="overflow: auto; height: 450px; width: 1100px;">
                    <table id="bookstable" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>View</th>
                              <th>Edit</th>
                              <th>Delete</th>
                              <th>ISBN</th>
                              <th>Cover</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Category</th>
                              <th>Publisher</th>
                              <th>Publication year</th>
                              <th>Date Added</th>
                              <th>Popularity</th>
                              <th>Cost</th>
                              <th>Author/s</th>
                              <th>In stock</th>
                          </tr>
                      </thead>
                      <tbody> 
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>ISBN</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Publisher</th>
                            <th>Publication year</th>
                            <th>Cost</th>
                            <th>Author/s</th>
                            <th>In stock</th>
                          </tr>
                      </tfoot>
                  </table>                  
                  </div>
              </div>
            </div>
      </div>
    </div>
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
                @csrf
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
    <!-- VIEW BOOK MODAL -->
    <div class="modal fade" id="viewbooksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Book information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="modalcntn"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- EDIT BOOK MODAL -->
    <div class="modal fade" id="editbooksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit book information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="edit-form">
              @csrf
              <div class="row">
                <div class="col-sm-4">
                  <label for="fname">Book Image:</label><br>
                  <div id="ebookImg"></div>
                  <input type="file" name="newbookimg" id="newbookimg" class="form-control-file">  
                  
                </div> <!--end-->

                <div class="col-sm-8">
                  <div class="form-group">
                    <div class="row">
                      <label for="fname">ISBN:</label>
                      <input type="text" id="eisbn" name="eisbn" class="form-control" readonly>                     
                    </div>
                    <div class="row">
                      <label for="fname">Book Title:</label>
                      <input type="text" id="ebookTitle" name="ebookTitle" class="form-control">
                    </div>
                    <div class="row">
                      <label for="mname">Description:</label><br> 
                      <textarea name="ebookDesc" id="ebookDesc" cols="30" rows="30" class="form-control"></textarea>
                    </div>
                    <div class="row">
                      <label for="lname">Category:</label>
                      <select name="ebookCat" id="ebookCat" class="form-control">

                      </select>
                    </div>
                    <div class="row">
                      <label for="fname">Publisher:</label>
                      <input type="text" id="epublisher" name="epublisher" class="form-control">
                    </div>
                    <div class="row">
                      <label for="fname">Year published:</label>
                      <input type="text" id="eyearPublished" name="eyearPublished" class="form-control">
                    </div>
                    <div class="row">
                      <label for="fname">Replacement Cost:</label>
                      <input type="number" id="ereplacementCost" name="ereplacementCost" min="0" step="any" class="form-control">
                    </div>
                    
                    <div class="row">
                      <label for="fname">Stocks:</label>
                      <input type="number" id="estocks" name="estocks" min="0" class="form-control">
                    </div>
                    <div class="row">
                      <label for="fname">Author/s:</label><br>
                      <textarea id="eauthor_fullname" name="eauthor_fullname" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <div id="preloader"></div>

    <!-- <script src="js/jquery.min.js"></script> -->
    <!-- <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="js/main.js"></script>
  </body>
</html>