
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

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $regno = $_POST['regno';
      $regno = 'GA 08 DE 6556';
    $select_v = $conn->prepare("SELECT * FROM `vehicle` WHERE `regno` = ?");
    $select_v->execute([$regno]);
    $row = $select_v->fetch(PDO::FETCH_ASSOC);
   }
   // $start = new DateTime($_SESSION['startdate']);
   //  $end = new DateTime($_SESSION['enddate']);
    $start = date_create("2022-12-01");
     $end = date_create("2022-12-22");
    $days= $start->diff($end);
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
    <link href="assets/css/booking.css" rel="stylesheet">

</head>
<body>

    <div   class ="container d-lg-flex">
        <div class="box-1 bg-light user">
            <div class="d-flex align-items-center mb-3">
                <img src="https://images.pexels.com/photos/4925916/pexels-photo-4925916.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                    class="pic rounded-circle" alt="">
                <p class="ps-2 name">Profile_Name</p>
            </div>
            <div class="box-inner-1 pb-3 mb-3 ">
                <div class="d-flex justify-content-between mb-3 userdetails">
                    <p class="fw-bold">mercedes</p>
                    <p class="fw-lighter"></p>
                </div>
                <div id="my" class="carousel slide carousel-fade img-details" data-bs-ride="carousel"
                    data-bs-interval="2000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#my" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#my" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#my" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://images.pexels.com/photos/100582/pexels-photo-100582.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                                class="d-block w-100">
                        </div>

                    </div>

                </div>
                <p class="dis info my-3"><?php $row['details']; ?>
                </p>


                    <label for="one" class="box py-2 first">
                        <div class="d-flex align-items-start">
                            <span ></span>
                            <div class="course">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold">
                                        start date
                                    </span>
                                    <span><?php echo date("F j, Y", $start);?></span>
                                </div>
                                <span></span>
                            </div>
                        </div>
                    </label>
                    <label for="two" class="box py-2 second">
                        <div class="d-flex">

                            <div class="course">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold">
                                       End date
                                    </span>
                                    <span><?php echo date("F j, Y", $end);?></span>
                                </div>

                            </div>
                        </div>
                    </label>

                   <br><br><br>

                    <div class="d-flex flex-column dis">

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Rate per Day</p>
                                <p><span >Rs.</span><?php $row['rate']; ?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Total Days</p>
                                <p><?php echo $days?></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="fw-bold">Total</p>
                                <p class="fw-bold"><span >Rs.</span><?php $total = $row['rate'] * $days; echo $total;?></p>
                            </div>

                        <div class="btn btn-primary mt-2">Pay_<span>Rs.</span>echo $total;
                        </div>
                    </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>
