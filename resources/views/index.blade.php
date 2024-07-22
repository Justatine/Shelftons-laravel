<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome to Shelftons | Shelftons</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <!-- Template Main JS File -->
    <script src="ind/assets/js/main.js"></script>

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

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="images/icon1.png" />
    <link href="ind/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="ind/assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="ind/assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="ind/assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="ind/assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />
    <link
      href="ind/assets/vendor/swiper/swiper-bundle.min.css"
      rel="stylesheet"
    />

    <!-- Template Main CSS File -->
    <link href="ind/assets/css/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/book-style.css" />

    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/dashboard-books.js"></script>

    <style>
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

  <body>
    <header
      id="header"
      class="header d-flex align-items-center"
      style="background-color: #dbb077"
    >
      <div
        class="container-fluid container-xl d-flex align-items-center justify-content-between"
      >
        <a href="{{ route('gotoIndex') }}" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1><img src="images/icon1.png" alt="" />Shelftons<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar">
          <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#portfolio">Portfolio</a></li>
            <li><a href="#team">Team</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route ('login') }}">Login</a></li>
          </ul>
        </nav>
        <!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      </div>
    </header>
    <!-- End Header -->
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero" style="height: 100vh">
      <div class="container position-relative">
        <div class="row gy-5" data-aos="fade-in">
          <div
            class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start"
          >
            <h2>Welcome to <span>Shelftons</span></h2>
            <p style="color: white">
              "Meet you next favourite book here at Shelftons."
            </p>
            <div class="d-flex justify-content-center justify-content-lg-start">
              <a href="#about" class="btn-get-started">Get Started</a>
              <a
                href="https://www.youtube.com/watch?v=LXb3EKWsInQ"
                class="glightbox btn-watch-video d-flex align-items-center"
                ><i class="bi bi-play-circle"></i><span>Watch Video</span></a
              >
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2">
            <img
              src="ind/assets/img/read.png"
              class="img-fluid"
              alt=""
              data-aos="zoom-out"
              data-aos-delay="100"
            />
          </div>
        </div>
      </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">
      <!-- ======= About Us Section ======= -->
      <section id="about" class="about">
        <div class="container" data-aos="fade-up">
          <div class="section-header mt-5">
            <h2>About Us</h2>
            <p>We've got what you always wanted to read!</p>
          </div>

          <div class="row gy-4">
            <div class="col-lg-6">
              <img
                src="ind/assets/img/about.jpg"
                class="img-fluid rounded-4 mb-4"
                alt=""
              />
              <h5>
                A library management system is software that is designed to
                manage all the functions of a library. It helps librarian to
                maintain the database of new books and the books that are
                borrowed by members along with their due dates.
              </h5>
              <br />
              <h5>
                This system completely automates all your library's activities.
              </h5>
            </div>
            <div class="col-lg-6">
              <div class="content ps-0 ps-lg-5">
                <!-- <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p> -->
                <ul>
                  <li>
                    <i class="bi bi-check-circle-fill"></i> The website allows users to search for books available in the library's collection and reserve them in advance. 
                  </li>
                  <li>
                    <i class="bi bi-check-circle-fill"></i> This ensures that the desired books are held for the patrons, reducing the chances of them being unavailable when they visit the library.
                  </li>
                  <li>
                    <i class="bi bi-check-circle-fill"></i> The website provides real-time information about the availability of books in the library's collection. 
                  </li>
                </ul>
                <p>
                  The website offers users a convenient way to handle their borrowing tasks. They have the ability to easily oversee their borrowed books, verify due dates, and renew or return books through online means. This simplifies the borrowing process and eliminates the necessity for traditional paperwork.
                </p>

                <div class="position-relative mt-4">
                  <img
                    src="ind/assets/img/about-2.jpg"
                    class="img-fluid rounded-4"
                    alt=""
                  />
                  <a
                    href="https://www.youtube.com/watch?v=LXb3EKWsInQ"
                    class="glightbox play-btn"
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End About Us Section -->

      <!-- ======= Our Services Section ======= -->
      <section id="services" class="services sections-bg">
        <div class="container" data-aos="fade-up">
          <div class="section-header mt-5">
            <h2>Our Services</h2>
            <p>
              Discover a world of literary wonders at your fingertips! Unveiling
              an enchanting assortment of treasures that await your exploration.
            </p>
          </div>

          <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-4 col-md-6">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="bi-book fs-1 text-dark"></i>
                </div>
                <h3>E-Book Borrowing</h3>
                <p>
                  A service that allows users to borrow e-books from the
                  library's digital collection. Users should be able to browse
                  and search for e-books and borrow them.
                </p>
                <a href="#" class="readmore stretched-link"
                  >Read more <i class="bi bi-arrow-right"></i
                ></a>
              </div>
            </div>
            <!-- End Service Item -->

            <div class="col-lg-4 col-md-6">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="bi-newspaper fs-1 text-dark"></i>
                </div>
                <h3>Digital Library Registration Card</h3>
                <p>
                  An online registration process that allows users to sign up
                  for a digital library card, which provides access to the
                  library's e-book borrowing services.
                </p>
                <a href="#" class="readmore stretched-link"
                  >Read more <i class="bi bi-arrow-right"></i
                ></a>
              </div>
            </div>
            <!-- End Service Item -->

            <div class="col-lg-4 col-md-6">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="bi-question-circle fs-1 text-dark"></i>
                </div>
                <h3>Help and Support</h3>
                <p>
                  Online help and support services, such as FAQs, live chat, or
                  email support, to assist users with any questions, issues, or
                  technical difficulties related to the e-book borrowing
                  service.
                </p>
                <a href="#" class="readmore stretched-link"
                  >Read more <i class="bi bi-arrow-right"></i
                ></a>
              </div>
            </div>
            <!-- End Service Item -->
          </div>
        </div>
      </section>
      <!-- End Our Services Section -->

      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
          <div class="section-header">
            <h2>Testimonials</h2>
            <p>
              As we navigate an overwhelming sea of information, these heartfelt
              accounts offer guidance and reassurance, guiding visitors to
              explore the vast resources, programs, and services that libraries
              have to offer.
            </p>
          </div>

          <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <div class="testimonial-item">
                    <div class="d-flex align-items-center">
                      <img
                        src="https://mu-ole.mu.edu.ph/pluginfile.php/2644/user/icon/sky_high/f1?rev=87264"
                        class="testimonial-img flex-shrink-0"
                        alt=""
                      />
                      <div>
                        <h3>John Micky Butanande</h3>
                        <h4>Ceo &amp; Founder / Bossing</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      "I am truly amazed by the e-library services provided. The
                      vast collection of digital books, journals, and resources
                      available at my fingertips has revolutionized my research
                      process. It's convenient, user-friendly, and has
                      significantly enhanced my learning experience."
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <div class="testimonial-item">
                    <div class="d-flex align-items-center">
                      <img
                        src="https://mu-ole.mu.edu.ph/pluginfile.php/2719/user/icon/sky_high/f1?rev=87328"
                        class="testimonial-img flex-shrink-0"
                        alt=""
                      />
                      <div>
                        <h3>Lloyd Clarence Maquiling</h3>
                        <h4>Former Child</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      "The e-library services have been a game-changer for me.
                      As a busy professional, I often struggle to find time to
                      visit physical libraries. With the e-library, I can access
                      a wealth of information from the comfort of my home or
                      office. It has opened up a world of knowledge and made
                      lifelong learning so much more accessible."
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <div class="testimonial-item">
                    <div class="d-flex align-items-center">
                      <img
                        src="https://mu-ole.mu.edu.ph/pluginfile.php/2676/user/icon/sky_high/f1?rev=87389"
                        class="testimonial-img flex-shrink-0"
                        alt=""
                      />
                      <div>
                        <h3>Jay Mar Phill Engracia</h3>
                        <h4>Store Owner / Designer</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      "I cannot express how grateful I am for the e-library
                      services. Being visually impaired, I faced challenges in
                      accessing print materials. The e-library's accessibility
                      features, such as screen reader compatibility and
                      adjustable font sizes, have made it possible for me to
                      indulge in my love for reading again. Thank you for making
                      literature inclusive and empowering."
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <div class="testimonial-item">
                    <div class="d-flex align-items-center">
                      <img
                        src="https://mu-ole.mu.edu.ph/pluginfile.php/2598/user/icon/sky_high/f1?rev=46523"
                        class="testimonial-img flex-shrink-0"
                        alt=""
                      />
                      <div>
                        <h3>Michael Paul Abangan</h3>
                        <h4>Freelancer / Designer</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      "The e-library's online courses and tutorials have been a
                      tremendous resource for self-improvement. I've been able
                      to learn new skills, expand my knowledge, and even pursue
                      certifications, all at my own pace. The interactive nature
                      of the courses and the ability to connect with instructors
                      and fellow learners have truly made it a transformative
                      learning experience."
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <div class="testimonial-item">
                    <div class="d-flex align-items-center">
                      <img
                        src="https://mu-ole.mu.edu.ph/pluginfile.php/2741/user/icon/sky_high/f1?rev=87337"
                        class="testimonial-img flex-shrink-0"
                        alt=""
                      />
                      <div>
                        <h3>Ruxe Pasok</h3>
                        <h4>Entrepreneur</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      "I am impressed by the e-library's commitment to staying
                      up-to-date with the latest technologies. The integration
                      of virtual reality and augmented reality experiences
                      within the library's digital platforms has brought a new
                      dimension to learning and exploration. It's an innovative
                      approach that engages users in a unique and immersive
                      way."
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              </div>
              <!-- End testimonial item -->
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </section>
      <!-- End Testimonials Section -->

      <!-- ======= Portfolio Section ======= -->
      <section id="portfolio" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">
          <div class="section-header mt-5">
            <h2>Portfolio</h2>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <h2
                style="
                  background-color: #dbb077;
                  text-align: center;
                  text-transform: uppercase;
                  padding: 10px 10px 10px 10px;
                "
                class="section-header"
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
                  background-color: #dbb077;
                  text-align: center;
                  text-transform: uppercase;
                  padding: 10px 10px 10px 10px;
                "
                class="section-header"
              >
                Popularity
              </h2>
              <div class="popularity"></div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Our Team Section -->

      <!-- ======= Our Team Section ======= -->
      <section id="team" class="team">
        <div class="container" data-aos="fade-up">
          <div class="section-header mt-5">
            <h2>Our Team</h2>
          </div>

          <div class="row gy-4">
            <center>
              <div
                class="col-xl-3 col-md-6 d-flex"
                data-aos="fade-up"
                data-aos-delay="100"
              >
                <div class="member">
                  <img src="images/gwapo.jpg" class="img-fluid" alt="" />
                  <h4>Justine Mark R. Taga-an</h4>
                  <span>Web Development</span>
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div>
              <!-- End Team Member -->
            </center>
          </div>
        </div>
      </section>
      <!-- End Our Team Section -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
          <div class="section-header mt-5">
            <h2>Contact</h2>
          </div>

          <div class="row gx-lg-0 gy-4">
            <div class="col-lg-4">
              <div
                class="info-container d-flex flex-column align-items-center justify-content-center"
              >
                <div class="info-item d-flex">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h4>Location:</h4>
                    <p>
                      Zamora Corner Abanil Street, Ozamiz City, Misamis
                      Occidental, 7200
                    </p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h4>Email:</h4>
                    <p>shelftons@gmail.com</p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-phone flex-shrink-0"></i>
                  <div>
                    <h4>Call:</h4>
                    <p>+63 905 575 7460</p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-clock flex-shrink-0"></i>
                  <div>
                    <h4>Open Hours:</h4>
                    <p>Mon-Sat: 11AM - 23PM</p>
                  </div>
                </div>
                <!-- End Info Item -->
              </div>
            </div>

            <div class="col-lg-8">
              <form
                action="forms/contact.php"
                method="post"
                role="form"
                class="php-email-form"
              >
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      id="name"
                      placeholder="Your Name"
                      required
                    />
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      id="email"
                      placeholder="Your Email"
                      required
                    />
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input
                    type="text"
                    class="form-control"
                    name="subject"
                    id="subject"
                    placeholder="Subject"
                    required
                  />
                </div>
                <div class="form-group mt-3">
                  <textarea
                    class="form-control"
                    name="message"
                    rows="7"
                    placeholder="Message"
                    required
                  ></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">
                    Your message has been sent. Thank you!
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit">Send Message</button>
                </div>
              </form>
            </div>
            <!-- End Contact Form -->
          </div>
        </div>
      </section>
      <!-- End Contact Section -->
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <span>Shelftons</span>
            </a>
            <p>
              A library management system is software that automates and
              oversees all library functions, including book database
              maintenance and tracking borrowed books and their due dates. .
            </p>
            <div class="social-links d-flex mt-4">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Web Development</a></li>
              <li><a href="#">Product Management</a></li>
              <li><a href="#">Marketing</a></li>
              <li><a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div
            class="col-lg-3 col-md-12 footer-contact text-center text-md-start"
          >
            <h4>Contact Us</h4>
            <p>
              Zamora Corner, Abanil Street <br />
              Misamis Occidental, 7200<br />
              Philippines<br /><br />
              <strong>Phone:</strong> +63 905 575 7460<br />
              <strong>Email:</strong> shelftons@gmail.com<br />
            </p>
          </div>
        </div>
      </div>

      <div class="container mt-4">
        <div class="copyright">
          &copy; Copyright <strong><span>Shelftons 2023</span></strong
          >. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
          Designed by
          <a href="https://bootstrapmade.com/">Justine Mark R. Taga-an</a>
        </div>
      </div>
    </footer>
    <!-- End Footer -->
    <!-- End Footer -->

    <!-- Book info -->
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

    <a
      href="#"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="ind/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="ind/assets/vendor/aos/aos.js"></script>
    <script src="ind/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="ind/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="ind/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="ind/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="ind/assets/vendor/php-email-form/validate.js"></script>
  </body>
</html>
