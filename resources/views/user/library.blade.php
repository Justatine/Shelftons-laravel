<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Library Explorer | Shelftons</title>
    <link rel="stylesheet" href="/css/user/css/style.css" />
    <link rel="icon" type="image/x-icon" href="../images/icon1.png" />

    <!-- Latest compiled and minified CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />

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

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,600,700"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,600,700"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <script src="../js/library.js"></script>
    <script src="../js/library-all-books.js"></script>
    <script src="../js/cookies.js"></script>
    <script src="../js/login/login-borrowers.js"></script>

    <!-- Loader -->
    <link rel="stylesheet" href="../css/preloader.css" />
    <script src="../js/preloader.js"></script>

    <style>
      @media (max-width: 767px) {
        #carouselExampleControls {
          display: none;
        }
      }
      .carousel-control-prev,
      .carousel-control-next {
        background-color: #e1e1e1;
        width: 5vh;
        height: 5vh;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
      }
      .card {
        position: relative;
        width: 11.875em;
        height: 16.5em;
        box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 120ms;
        display: inline-block;
        align-items: center;
        justify-content: center;
        background: #fff;
        padding: 0.5em;
        padding-bottom: 3.4em;
      }

      .card::after {
        content: "View";
        padding-top: 0.5em;
        padding-left: 1.25em;
        position: absolute;
        left: 0;
        bottom: -60px;
        background: #00ac7c;
        color: #fff;
        height: 2.5em;
        width: 100%;
        transition: all 80ms;
        font-weight: 600;
        text-transform: uppercase;
        opacity: 0;
      }

      .card .title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.9em;
        position: absolute;
        left: 0.625em;
        bottom: 1.875em;
        font-weight: 400;
        color: #000;
      }

      .card .price {
        font-family: Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
        font-size: 0.9em;
        position: absolute;
        left: 0.625em;
        bottom: 0.625em;
        color: #000;
      }

      .card:hover::after {
        bottom: 0;
        opacity: 1;
      }

      .card:active {
        transform: scale(0.98);
      }

      .card:active::after {
        content: "Viewed !";
        height: 3.125em;
      }

      .text {
        max-width: 55px;
      }

      .image {
        background: rgb(241, 241, 241);
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
      }
    </style>
  </head>
  <body style="background-image: url('/images/b7.jpg'); background-size: cover;">
    <nav id="navToggle" >
      <input id="nav-toggle" type="checkbox">
      <div class="logo"><img src="../images/logo.png" alt=""></div>
      <ul class="links">
          <li><a href="{{ route('user.index') }}" >Home</a></li>
          <li><a href="{{ route('user.library') }}" class="active">Library Explorer</a></li>
          <li><a href="{{ route('user.schedules') }}">Schedule of Returms</a></li>
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
        <h2
          style="
            background-color: rgba(136, 86, 59, 0.5);
            text-align: center;
            text-transform: uppercase;
            padding: 10px 10px 10px 10px;
            font-family: 'Roboto Slab', serif; ">
          Welcome to Shelftons !
        </h2>
        <div
          id="carouselExampleControls"
          class="carousel slide"
          data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="cards-wrapper">
                <div class="cards" style="width: 30%">
                  <img src="../images/ml2.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Virtual Library Explorer</h5>
                    <p class="card-text">
                      Digital shelves organized like a physical library.
                    </p>
                    <a href="#" class="btn btn-primary">Try</a>
                  </div>
                </div>
                <div class="cards" style="width: 30%">
                  <img src="../images/ml3.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Try Full Info Search</h5>
                    <p class="card-text">
                      Find matching results within the text of books we have.
                    </p>
                    <a href="search.html" class="btn btn-primary">Try</a>
                  </div>
                </div>
                <div class="cards" style="width: 30%">
                  <img src="../images/ml4.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">Borrowing Information</h5>
                    <p class="card-text" style="font-size: 11px">
                      Librarian will sign up the Library borrowing appointment
                      to schedule date and time pick up.
                    </p>
                    <a href="#" class="btn btn-primary">Got it</a>
                  </div>
                </div>
                <!--END OF SLIDE 1-->
              </div>
            </div>

            <div class="carousel-item">
              <div class="cards-wrapper">
                <div class="cards" style="width: 30%">
                  <img src="../images/ml1.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <p class="card-title">View Free Library Books Online</p>
                    <p class="card-text">
                      Controlled Digital System provides access to hundreds of
                      books.
                    </p>
                    <a href="#" class="btn btn-primary">Try</a>
                  </div>
                </div>

                <div class="cards" style="width: 30%">
                  <img src="../images/ml5.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <h5 class="card-title">How to borrow a book?</h5>
                    <p class="card-text">
                      We'll always contact you if you need to do anything!
                    </p>
                    <a
                      href="#"
                      class="btn btn-primary"
                      data-toggle="modal"
                      data-target="#guidlines"
                      >Click here to view guidelines</a
                    >
                  </div>
                </div>

                <div class="cards" style="width: 30%">
                  <img src="../images/ml5.png" class="card-img-top" alt="..." />
                  <div class="card-body">
                    <p class="card-title">Keep Track of your Favorite Books</p>
                    <p class="card-text">
                      Make use of your account to organize your books.
                    </p>
                    <a href="#" class="btn btn-primary">Try</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleControls"
            role="button"
            data-slide="prev"
            style="background-color: black"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleControls"
            role="button"
            data-slide="next"
            style="background-color: black"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="container">
          <br />
          <div class="row">
            <div class="col-sm-12">
              <h2
                style="
                  background-color: rgba(136, 86, 59, 0.5);
                  text-align: center;
                  text-transform: uppercase;
                  padding: 10px 10px 10px 10px;
                  font-family: 'Roboto Slab', serif;
                "
              >
                New releases (2023)
              </h2>
              <div class="new-releases"></div>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-sm-12">
              <h2
                style="
                  background-color: rgba(136, 86, 59, 0.5);
                  text-align: center;
                  text-transform: uppercase;
                  padding: 10px 10px 10px 10px;
                  font-family: 'Roboto Slab', serif;
                "
              >
                Popularity
              </h2>
              <div class="popularity"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-11">
            <br />
            <div class="row">
              <div class="btn-group dropleft">
                <button
                  type="button"
                  class="btn btn-secondary dropdown-toggle"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  Categories
                </button>
                <button type="button" class="btn btn-outline-primary viewall">
                  View all
                </button>

                <div class="dropdown-menu"></div>
              </div>
            </div>
            <br />
            <div class="cardcont"></div>
          </div>
        </div>
      </div>
      <!-- end of container -->
    </div>
    <!-- end for guide -->

    <!-- modal for guidlines-->
    <div
      class="modal fade"
      id="guidlines"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Borrowing Guidelines
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="../images/book-borrowing-guidlines.jpg" />
          </div>
        </div>
      </div>
    </div>
    <!-- Signout Modal -->
    <div
      class="modal fade"
      id="signout"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <center>
              <i
                class="fa fa-exclamation-circle"
                aria-hidden="true"
                style="font-size: 50px; color: red"
              ></i>
              <p>Do you want to signout?</p>
            </center>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <button type="submit" id="out" class="btn btn-danger">
              Signout
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Book Information</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="modalcntn"></div>
          </div>
          <div class="modal-footer"></div>
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
              <h3>
                &copy; Copyright 2022 Shelftons Public Library | All Rights
                Reserved
              </h3>
              <ul>
                <li><a href="#">Designed by:</a></li>
                <li><a href="#">Justine Mark R. Taga-an</a></li>
              </ul>
            </div>
            <div class="col-lg-3 item social">
              <a href="#"><i class="icon ion-social-facebook"></i></a
              ><a href="#"><i class="icon ion-social-twitter"></i></a
              ><a href="#"><i class="icon ion-social-snapchat"></i></a
              ><a href="#"><i class="icon ion-social-instagram"></i></a>
              <p class="copyright">Shelftons © 2022</p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <div id="preloader"></div>
    <script src="../js/js.js"></script>
  </body>
</html>
