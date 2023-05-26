<?php

include 'assets/php/_dbconnect.php';
// include_once('config.php');
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   if(isset($_SESSION['b_id'])){
     $b_id = $_SESSION['b_id'];
   }
   header('location: index.php');
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);


   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_UNSAFE_RAW);
   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_UNSAFE_RAW);
   $cpassword = sha1($_POST['cpassword']);
   $cpassword = filter_var($cpassword, FILTER_UNSAFE_RAW);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR phone = ?");
   $select_user->execute([$email, $phone]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      echo "<script> alert('Email/Phone Number is already registered !'); </script>";
   }else{
     $temp = (explode(" ",$name));
     $fname = current($temp);
     $lname = end($temp);
     $insert_user = $conn->prepare("INSERT INTO `users`(fname, lname, email, phone, password, date) VALUES(?,?,?,?,?,current_timestamp())");
     $insert_user->execute([$fname, $lname, $email, $phone, $cpassword]);
     $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
     $select_user->execute([$email, $password]);
     $row = $select_user->fetch(PDO::FETCH_ASSOC);
     if($select_user->rowCount() > 0){
       $_SESSION['user_id'] = $row['uno'];

       header('location:index.php');
     }
   }

}
//
// $login_button = '';
//
// //This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
// if(isset($_GET["code"]))
// {
//  //It will Attempt to exchange a code for an valid authentication token.
//  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
//
//  //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
//  if(!isset($token['error']))
//  {
//   //Set the access token used for requests
//   $google_client->setAccessToken($token['access_token']);
//
//   //Store "access_token" value in $_SESSION variable for future use.
//   $_SESSION['access_token'] = $token['access_token'];
//
//   //Create Object of Google Service OAuth 2 class
//   $google_service = new Google_Service_Oauth2($google_client);
//
//   //Get user profile data from google
//   $data = $google_service->userinfo->get();
//
//   if(!empty($data['email']))
//   {
//    $email = $data['email'];
//   }
//   if(!empty($data['']))
// }
//
// if(!isset($_SESSION['access_token']))
// {
//    $login_button = '<a class="btn btn-outline-dark btn-floating m-1" href="'.$google_client->createAuthUrl().'" role="button"><i class="fab fa-google"></i></a>';
// }
// }
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

  <!-- CSS Global -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel=" stylesheet">
    <!-- CSS only -->
  <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>

  <!-- Theme CSS -->
  <link href="assets/css/thememin.css" rel="stylesheet">
  <link href="assets/css/login.css" rel="stylesheet">

</head>

<body id="home" class="wide">
  <div class="header">
    <nav class="navbar navbar-dark navd">
      <div class="container-fluid">
        <a class="navbar-brand pb-2" href="index.php">Rent-a-Ride</a>
      </div>
    </nav>
  </div>

    <!-- Signup Form -->
  <section class="container-fluid forms">
    <div class="form signup">
      <div class="form-content">
        <header>Signup</header>
        <form id ="signup" action="" method="POST">
          <div class="field input-field">
            <input type="Name" placeholder="Name" class="input" id="name" name="name" autocomplete="off" required>
          </div>

          <div class="field input-field">
            <input type="email" placeholder="Email" class="input" id="email" name="email" autocomplete="off" required>
          </div>

          <div class="field input-field">
            <input type="tel" placeholder="Phone Number" class="input" id="phone" name="phone" autocomplete="off" required>
          </div>

          <div class="field input-field">
            <input type="password" placeholder="Create password" class="lpassword" id="password" name="password" required>
          </div>

          <div class="field input-field">
            <input type="password" placeholder="Confirm password" class="password" id="cpassword" name="cpassword" required>
            <i class='bx bx-hide eye-icon'></i>
          </div>

          <div class="field button-field">
            <button name="submit">Signup</button>
          </div>
        </form>

        <div class="form-link">
          <span>Already have an account? <a href="login.php">Login</a></span>
        </div>
      </div>

      <!-- <div class="line"></div>
      <div class="login-media">


        <a class="btn btn-outline-dark btn-floating m-1" href="https://www.facebook.com/" role="button"><i class="fab fa-facebook"></i></a> -->
        <?php
   // if($login_button == '')
   // {
   //
   // }
   // else
   // {
   //  echo $login_button;
   // }
   ?>
      </div>
    </div>
  </section>

   <?php include 'footer.php'; ?>

  <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
  </button>
  </div>
  <!-- /WRAPPER -->


  <!-- JS Global -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- <script src="assets/js/theme.js"></script> -->
  <script src="assets/js/login.js"></script>

</body>

</html>
