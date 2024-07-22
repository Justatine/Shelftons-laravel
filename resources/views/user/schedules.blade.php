<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schedules | Shelftons</title>
    <link rel="stylesheet" href="../css/user/css/style.css" />
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,600,700" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    
    <!--data tables-->  
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <script>
        $(document).ready(function () {
            $('#schedules').DataTable();
        });
    </script>  
    <script src="../js/schedules.js"></script>
    <script src="../js/cookies.js"></script>
    <script src="../js/login/login-borrowers.js"></script>
</head> 
<body style="background-image: url('/images/b7.jpg'); background-size: cover;">
    <nav id="navToggle" >
        <input id="nav-toggle" type="checkbox">
        <div class="logo"><img src="../images/logo.png" alt=""></div>
        <ul class="links">
            <li><a href="{{ route('user.index') }}" >Home</a></li>
            <li><a href="{{ route('user.library') }}">Library Explorer</a></li>
            <li><a href="{{ route('user.schedules') }}"class="active">Schedule of Returms</a></li>
            <li><a href="{{ route('user.search') }}">Find a book</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Account</a>
                <div class="dropdown-content">
                  <a href="{{ route('user.profile') }}">Profile</a>
                  <a href="#" data-toggle="modal" data-target="#signout">Logout</a>
                </div>
            </li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    <!-- content -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
        <div id="home">
            <div class="container">
                <h2 style="background-color: rgba(136,86,59,0.5); text-align:center; 
                text-transform: uppercase; padding: 10px 10px 10px 10px; font-family: 'Roboto Slab', serif;">
                    Check schedules here, and embark on an unforgettable borrowing experience!                
                </h2> 
                <div class="container1" style="z-index: 99;">      
                    <div class="row p-md-4">
                        <div id="bookstablecontainer" style="height: auto; width: 100%;">
                          <table id="schedules" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Author/s</th>
                                    <th>Patron</th>
                                    <th>Borrow Status</th>
                                    <th>Schedule of return</th>
                                    <th>Availability</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Author/s</th>
                                    <th>Patron</th>
                                    <th>Borrow Status</th>
                                    <th>Schedule of return</th>
                                    <th>Availability</th>
                                </tr>
                            </tfoot>
                        </table>                  
                        </div>
                    </div>
                  </div>
                </div>
            </div>

		<!--FOOTER-->
        <div class="footer-clean">
            <footer>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 col-md-3 item">
                            <h3>Navigation</h3>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="library.html">Library Explorer</a></li>
                                <li><a href="search.html">Find a book</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-3 item">
                            <h3>&copy; Copyright 2022 Shelftons Public Library | All Rights Reserved</h3>
                            <ul>
                                <li><a href="#">Designed by:</a></li>
                                <li><a href="#">Justine Mark R. Taga-an</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                            <p class="copyright">Shelftons © 2022</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Signout Modal -->
        <div class="modal fade" id="signout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
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
</body>
</html>