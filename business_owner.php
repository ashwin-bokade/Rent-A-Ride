<?php

include 'assets/php/_dbconnect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel=" stylesheet">
  <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>

  <link href="assets/css/thememin.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/user_page.css">
  <link rel="stylesheet" href="assets/css/business_owner.css">

</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="container-fluid">
    <div class="row content">
      <h1>Business Owner Page</h1>
      <div class="col-sm-2 sidenav">
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a data-toggle="pill" href="#account">Account Info</a></li>
          <li><a data-toggle="pill" href="#business">Business Info</a></li>
          <li><a data-toggle="pill" href="#manage">Manage</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div id="account" class="tab-pane fade in active">
          <h1>Account Info</h1>
          <div class="col-sm-10">
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
              <img src="assets\img\user.png" alt="profile_photo" height="100px" width="100px" style="border-radius: 50%;">
            </div>
            <div class="col-sm-1">
              <button id="edit" class="btn btn-primary me-md-2">Edit</button>
              <script>
                $(document).ready(function() {
                  $('#edit').click(function() {
                    $("#name").focus();
                  })
                });
              </script>
            </div>
            <form class="form-horizontal" name="contactForm" onsubmit="return validateForm()" action="confirm.html" method="post">
              <div class="form-group">

              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">Name</label>
                <div class="col-sm-3">
                  <input class="form-control" id="name" type="text" name="name" placeholder="Enter your name">
                  <div class="error" id="nameErr"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">Email</label>
                <div class="col-sm-3">
                  <input class="form-control" type="text" name="email" placeholder="Enter your email">
                  <div class="error" id="emailErr"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">Mobile No</label>
                <div class="col-sm-3">
                  <input maxlength="10" class="form-control" type="text" name="mobile" placeholder="Enter your Mobile Number">
                  <div class="error" id="mobileErr"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">Address</label>
                <div class="col-sm-3">
                  <input class="form-control" type="text" name="address" placeholder="Enter your Address">
                  <div class="error" id="addressErr"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">City/Town</label>
                <div class="col-sm-3">
                  <input class="form-control" type="text" name="city" placeholder="Enter your City/Town">
                  <div class="error" id="cityErr"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">State</label>
                <div class="col-sm-3">
                  <input class="form-control" type="text" name="state" placeholder="Enter your State">
                  <div class="error" id="stateErr"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">ZipCode</label>
                <div class="col-sm-3">
                  <input maxlength="6" class="form-control" type="text" name="zip" placeholder="Enter your ZipCode">
                  <div class="error" id="zipErr"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                  <input type="submit" value="Submit" class="btn btn-success">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div id="business" class="tab-pane fade">
          <h1>Business Info</h1>
        </div>

        <div id="manage" class="tab-pane fade">
          <h1>Manage</h1>
          <div class="col-sm-8">
            <div class="container">
              <div class="table-wrapper">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-8">
                      <h2>Vehicle <b>Details</b></h2>
                    </div>
                    <div class="col-sm-4">
                      <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                  </div>
                </div>
                <table id="table1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Brand</th>
                      <th>Name</th>
                      <th>RegNo</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tata</td>
                      <td>Tigor</td>
                      <td>KA22B6078</td>
                      <td>Petrol</td>
                      <td><span class="label label-danger">Booked</span></td>
                      <td>
                        <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons"></i></a>
                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons"></i></a>
                        <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tata</td>
                      <td>Safari</td>
                      <td>KA22B6078</td>
                      <td>Diesel</td>
                      <td><span class="label label-success">UnBooked</span></td>
                      <td>
                        <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons"></i></a>
                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons"></i></a>
                        <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tata</td>
                      <td>Nexon</td>
                      <td>KA22B6078</td>
                      <td>Electric</td>
                      <td><span class="label label-danger">Booked</span></td>
                      <td>
                        <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons"></i></a>
                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons"></i></a>
                        <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Booking Details table -->
          <div class="col-sm-8">
            <div class="container">
              <div class="table-wrapper">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-8">
                      <h2>Booking Details <b>Details</b></h2>
                    </div>
                    <!-- <div class="col-sm-4">
                              <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                          </div> -->
                  </div>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>RegNo</th>
                      <th>Uname</th>
                      <th>Uphoneno</th>
                      <th>From</th>
                      <th>To</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tata</td>
                      <td>Tigor</td>
                      <td>KA22B6078</td>
                      <td>Petrol</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Tata</td>
                      <td>Tigor</td>
                      <td>KA22B6078</td>
                      <td>Petrol</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Tata</td>
                      <td>Tigor</td>
                      <td>KA22B6078</td>
                      <td>Petrol</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <?php include 'footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/business_owner.js"></script>
  <script src="assets/js/form.js"></script>
</body>

</html>
