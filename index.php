<?php

include 'assets/php/_dbconnect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   if(isset($_SESSION['b_id'])){
     $b_id = $_SESSION['b_id'];
   }else{
     $b_id = '';
   }
}else{
   $user_id = '';
   $b_id = '';}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Rent-A-Ride</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon_io/favicon-16x16.png">
  <link rel="manifest" href="assests/favicon_io/site.webmanifest">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel=" stylesheet">
  <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>

  <link href="assets/css/thememin.css" rel="stylesheet">

</head>


<!-- WRAPPER -->
<div class="wrapper" id="index">

<?php include 'navbar.php'; ?>
  <!-- CONTENT AREA -->
  <div class="content-area">
    <!-- PAGE -->
    <section class="page-section no-padding">
      <div class="title-container">
        <div class="title-text">Search, Book and <br />Rent Vehicle<br /> Easily.</div>
        <a href="search.php"><button class="btn btn-outline-dark glow-button mx-auto search-btn">Search Your Ride</button></a>
      </div>
    </section>
    <!-- /PAGE -->


    <section class="Details">
      <div class="flex-container">

        <div class="thumbnail p-0">
          <div class="caption happy">
            <div class="caption-icon"><i class="fa fa-heart"></i></div>
            <div class="caption-number">5657</div>
            <h4 class="caption-title">Happy costumers</h4>
          </div>
        </div>

        <div class="thumbnail p-0">
          <div class="caption car">
            <div class="caption-icon"><i class="fa fa-car"></i></div>
            <div class="caption-number">657</div>
            <h4 class="caption-title">Total Vehicles</h4>
          </div>
        </div>


        <div class="thumbnail p-0">
          <div class="caption rating">
            <div class="caption-icon"><i class="fa fa-star"></i></div>
            <div class="caption-number">4.1</div>
            <h4 class="caption-title">Average Ratings</h4>
          </div>
        </div>
      </div>
    </section>
    <!-- /PAGE -->
    <!-- PAGE -->
    <section id="testimonial">
      <h2>Testimonials</h2>
      <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner ">
          <div class="carousel-item active" data-bs-interval="10000">
            <div class="img-box"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlciUyMHByb2ZpbGV8ZW58MHx8MHx8&w=1000&q=80" alt=""></div>
            <p class="testimonial-text">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt. Phasellus risus risus, volutpat vel tellus ac,
              tincidunt fringilla massa. Etiam hendrerit dolor eget rutrum.</p>
            <p class="overview">Michael Holz</p>
            <div class="star-rating">
              <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
              </ul>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <div class="img-box"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlciUyMHByb2ZpbGV8ZW58MHx8MHx8&w=1000&q=80" alt=""></div>

            <p class="testimonial-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum idac nisl bibendum
              scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
            <p class="overview">Paula Wilson</p>
            <div class="star-rating">
              <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
              </ul>
            </div>
          </div>
          <div class="carousel-item">
            <div class="img-box"><img src="https://images.unsplash.com/photo-1489980557514-251d61e3eeb6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt=""></div>
            <p class="testimonial-text">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Utmtc tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet
              gravida nibh, facilisis gravida odio. Phasellus auctor velit.</p>
            <p class="overview">Antonio Moreno</p>
            <div class="star-rating">
              <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star-half-o"></i></li>
              </ul>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <i class="fa fa-angle-left"></i>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <i class="fa fa-angle-right"></i>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
  </div>

  <!-- /PAGE -->
 <?php include 'footer.php'; ?>

  <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
  </button>
  </div>
<!-- /WRAPPER -->


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="assets/js/theme.js"></script>

</body>

</html>
