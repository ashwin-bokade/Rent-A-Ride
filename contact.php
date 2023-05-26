<?php

include 'assets/php/_dbconnect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel=" stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>
    <!-- Style -->
    <link href="assets/css/thememin.css" rel="stylesheet">

  </head>
  <body>
    <div id="contact-page">

    <?php include 'navbar.php'; ?>
    <div class="contactus">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mr-auto">
          <div class="mb-5">
            <h2 class="mb-3">Contact Info</h2>
            <p>If you have any questions or queries a member of staff will always be happy to help.Feel free to contact us</p>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3 class="mb-3">Goa</h3>
              <ul class="list-unstyled mb-5">
                <li><i class="fa-sharp fa-solid fa-location-dot"></i> GEC, Farmagudi, Ponda, Goa 000010</li>
                <li><i class="fa-solid fa-phone"></i>+91 6545646545</li>
                <li><i class="fa-solid fa-envelope"></i>info@rent-a-ride.com </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="box">
            <h3 class="heading">Send us a message</h3>
            <form class="mb-5" method="post" id="contactForm" name="contactForm">
              <div class="row">

                <div class="col-md-12 form-group">
                  <label for="name" class="col-form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="name" autocomplete="off" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-12 form-group">
                  <label for="message" class="col-form-label">Message</label>
                  <textarea class="form-control" name="message" id="message" cols="30" rows="7" autocomplete="off" required></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-block">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

   <?php include 'footer.php'; ?>

  <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
  </button>


  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
  <script src="assets/js/theme.js">

  </script>
  <script type="text/javascript">
   (function(){
      emailjs.init('9EbBYoSgiWub6BazZ');
   })();
   </script>
   <script src="assets/js/mail.js"></script>
  </body>
</html>
