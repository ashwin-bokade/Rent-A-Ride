<?php

include 'assets/php/_dbconnect.php';

session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


  if(isset($_POST['submit0'])){
      $_SESSION['type'] ='car';
      $_SESSION['startdate'] = date('Y-m-d', strtotime($_POST['startdate']));
      $_SESSION['enddate'] =date('Y-m-d', strtotime($_POST['enddate']));
      $_SESSION['location'] = $_POST['location'];
  }

  if(isset($_POST['submit1'])){
    $_SESSION['type'] ='bike';
    $_SESSION['startdate'] = date('Y-m-d', strtotime($_POST['startdate']));
    $_SESSION['enddate'] =date('Y-m-d', strtotime($_POST['enddate']));
    $_SESSION['location'] = $_POST['location'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Rent-A-Ride</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon_io/favicon-16x16.png">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel=" stylesheet">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>


  <link href="assets/css/thememin.css" rel="stylesheet">
</head>

<body id="listing" class="wide">
    <?php include 'navbar.php'; ?>
  <div>

    <!-- /HEADER -->
    <section class="listing">
      <div class="filter-btn" onclick="filterr()">
        <i class="fa-solid fa-filter"></i>
      </div>
      <div class="filter-section hide">

          <a href="#" onclick="reset()">RESET</a>
        <div class="sort-section">
          <h4>Sort By:</h4>
          <div class="form-check">
            <input class="form-check-input sort" type="radio" name="sort" id="sort_low" value="asc">
            <label class="form-check-label" for="sort_low">
              Low to High Price
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input sort" type="radio" name="sort" id="sort_high" value="desc">
            <label class="form-check-label" for="sort_low">
              High to Low Price
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input sort" type="radio" name="sort" id="sort_dist" value="asc_d">
            <label class="form-check-label" for="sort_low">
              Low to High Distance
            </label>
          </div>
        </div>
        <div class="price-slider">
          <h4>Price Range</h4>
           <div class="row">
             <div class="col-6">
               <label class="price-label" for="min">Min</label>
                <input type="text" id="price-range-min" >
             </div>
             <div class="col-6">
               <label class="price-label" for="max">Max</label>
               <input type="text" id="price-range-max" >
             </div>
           </div>

          <div id="price-slider"></div>
        </div>
        <div class="car-variant">
          <h4>Car type</h4>
          <div class="form-check">
            <input class="form-check-input variant" type="checkbox" name="variant" value="sedan">
            <label class="form-check-label" for="sedan">
              Sedan
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input variant" type="checkbox" name="variant"   value="hatchback">
            <label class="form-check-label" for="hatchback">
              Hatchback
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input variant"  type="checkbox" name="variant"  value="suv">
            <label class="form-check-label" for="suv">
              SUV
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input variant"  type="checkbox" name="variant" value="muv">
            <label class="form-check-label" for="muv">
              MUV
            </label>
          </div>
        </div>
        <div class="fuel-type">
          <h4>Fuel type</h4>
          <div class="form-check ">
            <input class="form-check-input fuel" type="checkbox" name="fuel" value="petrol">
            <label class="form-check-label" for="petrol">Petrol</label>
          </div>
          <div class="form-check ">
            <input class="form-check-input fuel"  type="checkbox" name="fuel" value="diesel">
            <label class="form-check-label" for="diesel">Diesel</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input fuel" type="checkbox" name="fuel" value="electric">
            <label class="form-check-label" for="electric">Electric</label>
          </div>
        </div>
        <div class="trans-type">
          <h4>Transmission</h4>
          <div class="form-check ">
            <input class="form-check-input trans" type="checkbox" name="trans" value="manual">
            <label class="form-check-label" for="manual">Manual</label>
          </div>
          <div class="form-check ">
            <input class="form-check-input trans" type="checkbox" name="trans" value="automatic">
            <label class="form-check-label" for="automatic">Automatic</label>
          </div>

        </div>
          </form>
        </div>
      <div class="listing-container">
        <div class="filter_data">

        </div>
      </div>

    </section>
     <?php include 'footer.php'; ?>
   </div>
    <!-- CONTENT AREA -->

    <!-- FOOTER -->



  <!-- JS Global -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="assets/js/theme.js"></script>

</body>

</html>
