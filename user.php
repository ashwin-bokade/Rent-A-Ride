<?php

include 'assets/php/_dbconnect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   if(isset($_SESSION['b_id'])){
     $b_id = $_SESSION['b_id'];
   }
}else{
   $user_id = '';

    header('location: login.php');
}

if (isset($_POST['user-save'])) {
  if (isset($_SESSION['form_token'])) {
   if ($_SESSION['form_token'] == $_POST['form_token']) {
    if (!is_writable('user-profile')) {
       chmod('user-profile',0777);
     }
   $bp_url = null;
    // Update the user details in the database
    $first_name = $_POST['inputFirstName'];
    $last_name = $_POST['inputLastName'];
    $phone = $_POST['inputPhone'];
    $email = $_POST['inputEmailAddress'];
    $location = $_POST['address'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $info = getimagesize($_FILES['image']['tmp_name']);
        if ($info !== false) {
      $existingPhoto = 'user-profile/'. $user_id .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      if (file_exists($existingPhoto)) {
        unlink($existingPhoto);
      }
      $bp_url = 'user-profile/'. $user_id .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES['image']['tmp_name'], $bp_url);
      }
     }

    $stmt = $conn->prepare("UPDATE `users` SET `fname` = ?, `lname` = ?, `p_url` = ?, `address` = ?, `email` = ?, `phone` = ? WHERE `uno` = ?");
    $stmt->execute([$first_name,$last_name,$bp_url,$location,$email,$phone,$user_id]);
    unset($_SESSION['form_token']);
   }
  }
 }
  else{
    $_SESSION['form_token'] = bin2hex(openssl_random_pseudo_bytes(32));
  }


  if (isset($_POST['business-save'])) {
      if (!is_writable('business-profile')) {
         chmod('business-profile',0777);
       }
     $bp_url = null;
      // Update the user details in the database
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $state = $_POST['state'];
      $city = $_POST['city'];

      if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $info = getimagesize($_FILES['image']['tmp_name']);
          if ($info !== false) {
        $existingPhoto = 'business-profile/'. $user_id .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (file_exists($existingPhoto)) {
          unlink($existingPhoto);
        }
        $bp_url = 'business-profile/'. $user_id .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], $bp_url);
        }
       }

      $stmt = $conn->prepare("UPDATE `business` SET `bname` = ?, `bphone` = ?, `bemail` = ?, `baddress` = ?, `state` = ?, `city` = ?,`bp_url` = ?  WHERE `bid` = ?");
      $stmt->execute([$name,$phone,$email,$address,$state,$city,$bp_url,$b_id]);
      unset($_SESSION['form_token']);
     }





  $stmt = $conn->prepare("SELECT * FROM `users` WHERE `uno`=?");
  $stmt->execute([$user_id]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt1 = $conn->prepare("SELECT * FROM `business` WHERE `bid`=?");
  $stmt1->execute([$b_id]);
  $bus = $stmt1->fetch(PDO::FETCH_ASSOC);

  $ud = $conn->prepare("SELECT * FROM `b_bdetails` WHERE `bid`=? order by `bdate` desc");
  $ud->execute([$b_id]);

  $bd = $conn->prepare("SELECT * FROM `user_bdetails` WHERE `uno`=? order by `bdate` desc");
  $bd->execute([$user_id]);
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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;700;800&family=Ubuntu:wght@300;400;500;700&display=swap"
    rel=" stylesheet">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link href="assets/css/thememin.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/user_page.css">
</head>

<body id="profile">
  <?php include 'navbar.php'; ?>
      <div class="row flex-nowrap sidebar">
          <div class="col-auto col-sm-4 col-md-3 col-xl-2 px-0 bg-dark bar">
              <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                  <ul class="nav nav-tabs flex-column mb-sm-auto mb-0 align-items-center  min-vh-100" id="menu">
                      <li class="nav-item active" role="presentation">
                          <button class="nav-link active"  data-bs-toggle="tab" data-bs-target="#account">
                            <i class="fs-4 bi bi-person-fill-gear"></i> <span class="ms-1 d-none d-sm-inline">Account Info</span></button>
                      </li>
                      <li class="nav-item " role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bookings">
                          <i class="fs-4 bi-table"></i>  <span class="ms-1 d-none d-sm-inline">Bookings</span> </button>
                      </li>
                      <?php
                       if($user['role']=="owner"){
                         echo '
                      <li class="nav-item " role="presentation">
                        <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#business">
                          <i class="fs-4 bi bi-building-gear"></i>  <span class="ms-1 d-none d-sm-inline">Business Info</span> </button>
                      </li>
                      <li class="nav-item " role="presentation">
                        <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#manage">
                          <i class="fs-4 bi bi-car-front-fill"></i>  <span class="ms-1 d-none d-sm-inline">Manage</span> </button>
                      </li>';
                      }
                      ?>
                      <li class="nav-item" role="presentation">
                        <a href="logout.php"><button class="nav-link w-100">
                            <i class="fs-4 bi bi-box-arrow-left"></i>  <span class="ms-1 d-none d-sm-inline">Logout</span> </button></a>
                      </li>
                  </ul>
                  <hr>
              </div>
          </div>
    <div class="col pt-5 tab-content">
        <div id="account" class="tab-pane fade show active">
          <div class="container">
              <h1>Account Details</h1>
                  <form id="user-details"  method="POST" enctype="multipart/form-data">

                      <div class="avatar-upload">
                          <div class="avatar-edit">
                              <input type="file" id="uimage" name="image" readonly>
                              <label for="uimage" ></label>
                          </div>
                          <div class="avatar-preview">
                              <div id="uimagePreview" style="background-image: url('<?php if($user['p_url'] == null){echo 'assets/img/user.png';}else{echo $user['p_url']; }?>');">
                              </div>
                          </div>
                      </div>
                      <div class="row gx-5 mb-3">
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputFirstName">First name</label>
                              <input class="form-control" id="inputFirstName" name="inputFirstName"  type="text" placeholder="Enter your first name" value="<?php echo $user['fname']; ?>" autocomplete="off" required readonly>
                          </div>
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputLastName">Last name</label>
                              <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $user['lname']; ?>" autocomplete="off" required readonly>
                          </div>
                      </div>
                      <!-- Form Row        -->
                      <div class="row gx-5 mb-3">
                          <!-- Form Group (location)-->
                          <div class="col-md-6">
                            <input type="hidden" name="form_token" value='<?php echo $_SESSION['form_token']; ?>'>
                              <label class="small mb-1" for="inputPhone">Phone number</label>
                              <input class="form-control" id="inputPhone" name="inputPhone" type="tel" placeholder="Enter your phone number" value="<?php echo $user['phone']; ?>" autocomplete="off" required readonly>
                          </div>
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputEmailAddress">Email address</label>
                              <input class="form-control" id="inputEmailAddress" name="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $user['email']; ?>" autocomplete="off" required readonly>
                          </div>
                      </div>

                      <div class="row gx-5 mb-3">
                        <div class="col-12">
                          <label class="small mb-1" for="address">Address</label>
                          <input class="form-control" id="address" name="address" type="text" placeholder="Enter your address" value="<?php echo $user['address']; ?>" autocomplete="off" required readonly>
                        </div>
                      </div>

                      <div class="row mt-5 mb-3">
                        <div class="col-xs-6 col-sm-5">
                          <button class="edit" type="button">Edit</button>
                          <button class="save d-none" name="user-save" type="submit">Save changes</button>
                        </div>
                      </div>
                  </form>
           </div>
        </div>

        <div class="tab-pane fade" id="bookings" role="tabpanel">
          <div class="container">
              <h1 class="mb-4">My Bookings</h1>
              <div class="overflow-auto table-con">
              <table class="table custom-table">
                <thead class="table-sticky">
                  <tr>
                    <th class="col-3">Booking ID</th>
                    <th class="col-3">Owner</th>
                    <th class="col-3">Vehicle</th>
                    <th class="col-3">From</th>
                    <th class="col-3">To</th>
                    <th class="col-3">Status</th>
                    <th class="col-3">Amount</th>
                    <th class="col-3">Date</th>
                  </tr>
                </thead>
                <tbody id="tableb">
                  <?php
                   $output = '';
                   while ($bdetails = $bd->fetch(PDO::FETCH_ASSOC)) {
                     $datef = new DateTime($bdetails['fromdate']);
                     $datet = new DateTime($bdetails['todate']);
                     $dateb = new DateTime($bdetails['bdate']);
                     if($bdetails['status']=='active'){
                       $status = '<span class="badge text-bg-success">Active</span>';
                     }elseif($bdetails['status']=='upcoming'){
                       $status = '<span class="badge rounded-pill text-bg-warning">Upcoming</span>';
                     }else{
                       $status = '<span class="badge rounded-pill text-bg-secondary">Finished</span>';
                     }
                      $output.='<tr>
                         <td>'. $bdetails['bookingid'] .'</td>
                         <td> <a>'.$bdetails['bname'] .'</a> </td>
                         <td>'.$bdetails['vbrand'] .' '.$bdetails['vname'] .'</td>
                         <td>'.$datef->format('F d, Y').'</td>
                         <td>'.$datet->format('F d, Y').'</td>
                         <td>'.$status.'</td>
                         <td>'.$bdetails['total'].'</td>
                         <td>'.$dateb->format('F d, Y, h:i a').'</td>
                       </tr>';
                     }
                     echo $output;
                   ?>
                </tbody>
              </table>
              </div>
          </div>
      </div>
    <?php
      if(isset($_SESSION['b_id'])){
    ?>
      <div class="tab-pane fade" id="business" role="tabpanel">
        <div class="container">
            <h1>Business Details</h1>
                <form id="business-details"  method="POST" enctype="multipart/form-data">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" id="bimage" name="image" readonly>
                            <label for="bimage"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="bimagePreview" style="background-image: url('<?php if($bus['bp_url'] == null){echo 'assets/img/user.png';}else{echo $bus['bp_url'];}?>');">
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="name">Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your business name" value="<?php echo $bus['bname']; ?>" autocomplete="off" required readonly >
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">Email address</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Enter your business email address" value="<?php echo $bus['bemail']; ?>" autocomplete="off" required readonly >
                        </div>
                    </div>
                    <div class="row gx-5 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phone">Phone number</label>
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Enter your business phone number" value="<?php echo $bus['bphone']; ?>" autocomplete="off" required  readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="small mb-1" for="state">State</label>
                            <input class="form-control" id="state" name="state" type="text" placeholder="State" value="<?php echo $bus['state']; ?>" autocomplete="off" required readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="small mb-1" for="city">City/Town</label>
                            <input class="form-control" id="city" name="city" type="text" placeholder="City/Town" value="<?php echo $bus['city']; ?>" autocomplete="off" required readonly>
                        </div>
                    </div>

                    <div class="row gx-5 mb-3">
                      <div class="col-12">
                        <label class="small mb-1" for="address">Address</label>
                        <input class="form-control" id="address" name="address" type="text" placeholder="Enter your business address" value="<?php echo $bus['baddress']; ?>" autocomplete="off" required readonly>
                      </div>
                    </div>

                    <div class="row mt-5 mb-3">
                      <div class="col-xs-6 col-sm-5">
                        <button class="edit" type="button">Edit</button>
                        <button class="save d-none" type="submit" name="business-save">Save changes</button>
                      </div>
                    </div>
                </form>
         </div>
      </div>
      <div class="tab-pane fade" id="manage" role="tabpanel">
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Manage <b>Vehicles</b></h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="#addvehicle" class="btn btn-success" data-bs-toggle="modal"><i class="fa-solid fa-plus"></i> <span>Add New Vehicles</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="carTable table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Registration No</th>
                                <th>Brand</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Variant</th>
                                <th>Transmission</th>
                                <th>Fuel</th>
                                <th>Rate</th>
                                <th>Rating</th>
                                <th>Edit/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>
                </div>
            <!-- Edit Modal HTML -->
            <div id="addvehicle" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="add-form" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Vehicle</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                              						<div class="avatar-upload">
                              								<div class="avatar-edit">
                              										<input type="file" id="aimage" name="image">
                              										<label for="aimage"></label>
                              								</div>
                              								<div class="avatar-preview">
                              										<div id="aimagePreview" style="background-image: url('assets/img/vehicle.jpg');">
                              										</div>
                              								</div>
                              						</div>
                              						<div class="row gx-5 mb-3">
                              								<div class="col-md-6">
                                                  <input type="hidden" class="form-control" id="mode" name="mode" value="add">
                              										<label class="small mb-1" for="brand">Brand</label>
                              										<input class="form-control" id="brand" name="brand" type="text" placeholder="Brand" autocomplete="off" required >
                              								</div>
                              								<div class="col-md-6">
                              										<label class="small mb-1" for="name">Name</label>
                              										<input class="form-control" id="name" name="name" type="text" placeholder="Name" autocomplete="off" required >
                              								</div>
                              						</div>
                              						<div class="row gx-5 mb-3">
                              								<div class="col-md-6">
                              										<label class="small mb-1" for="regno">Registration Number</label>
                              										<input class="form-control" id="regno" name="regno" type="text" placeholder="Reg. No" autocomplete="off" required >
                              								</div>
                              								<div class="col-md-3">
                              										<label class="small mb-1" for="type">Type</label>
                              										<select class="form-select" id="type" name="type">
                              										    <option selected>Choose...</option>
                              										    <option value="car">Car</option>
                              										    <option value="bike">Bike</option>
                              										</select>
                              								</div>
                              								<div class="col-md-3">
                              									<label class="small mb-1" for="variant">Variant</label>
                              									<select class="form-select" id="variant" name="variant">
                              											<option selected>Choose...</option>
                              											<option value="suv">SUV</option>
                              											<option value="sedan">Sedan</option>
                              											<option value="hatchback">Hatchback</option>
                              											<option value="muv">MUV</option>
                              									</select>
                              								</div>
                              						</div>

                              						<div class="row gx-5 mb-3">
                              							<div class="col-4">
                              								<label class="small mb-1" for="trans">Transmission</label>
                              								<select class="form-select" id="trans" name="trans">
                              										<option selected>Choose...</option>
                              										<option value="automatic">Automatic</option>
                              										<option value="manual">Manual</option>
                              								</select>
                              							</div>
                              								<div class="col-4">
                              									<label class="small mb-1" for="fuel">Fuel</label>
                              									<select class="form-select" id="fuel" name="fuel">
                              											<option selected>Choose...</option>
                              											<option value="petrol">Petrol</option>
                              											<option value="diesel">Diesel</option>
                              											<option value="electric">Electric</option>
                              									</select>
                              								</div>
                              								<div class="col-4">
                              									<label class="small mb-1" for="rate">Rate per Day</label>
                              									<input class="form-control" type="text" id="rate" name="rate" placeholder="Rs" value="" autocomplete="off" required >
                              								</div>
                              							</div>
                                            <div class="row gx-5 mb-3">
                                              <div class="col-12">
                                                <label class="small mb-1" for="details">Details</label>
                                                <textarea class="form-control" name="details" id="details" cols="30" rows="6" autocomplete="off"></textarea>
                                              </div>
                                            </div>
                              			</div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editvehicle" class="modal fade">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <form id="update-form" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                              <h4 class="modal-title">Edit Vehicle</h4>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type="file" id="eimage" name="image">
                                                <label for="eimage"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="eimagePreview" style="background-image: url('assets/img/vehicle.jpg');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gx-5 mb-3">
                                            <div class="col-md-6">
                                                <input type="hidden" class="form-control" id="mode" name="mode" value="update">
                                                <label class="small mb-1" for="brand">Brand</label>
                                                <input class="form-control" id="brand" name="brand" type="text" val="" placeholder="Brand" autocomplete="off" required >
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="name">Name</label>
                                                <input class="form-control" id="name" name="name" type="text" val="" placeholder="Name" autocomplete="off" required >
                                            </div>
                                        </div>
                                        <div class="row gx-5 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="regno">Registration Number</label>
                                                <input class="form-control" id="regno" name="regno" type="text" val="" placeholder="Reg. No"autocomplete="off" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="small mb-1" for="type">Type</label>
                                                <select class="form-select" id="type" name="type" required>
                                                    <option selected>Choose...</option>
                                                    <option value="car">Car</option>
                                                    <option value="bike">Bike</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                              <label class="small mb-1" for="variant">Variant</label>
                                              <select class="form-select" id="variant" name="variant" required>
                                                  <option selected>Choose...</option>
                                                  <option value="suv">SUV</option>
                                                  <option value="sedan">Sedan</option>
                                                  <option value="hatchback">Hatchback</option>
                                                  <option value="muv">MUV</option>
                                              </select>
                                            </div>
                                        </div>

                                        <div class="row gx-5 mb-3">
                                          <div class="col-4">
                                            <label class="small mb-1" for="trans">Transmission</label>
                                            <select class="form-select" id="trans" name="trans" required>
                                                <option selected>Choose...</option>
                                                <option value="automatic">Automatic</option>
                                                <option value="manual">Manual</option>
                                            </select>
                                          </div>
                                            <div class="col-4">
                                              <label class="small mb-1" for="fuel">Fuel</label>
                                              <select class="form-select" id="fuel" name="fuel" required>
                                                  <option selected>Choose...</option>
                                                  <option value="petrol">Petrol</option>
                                                  <option value="diesel">Diesel</option>
                                                  <option value="electric">Electric</option>
                                              </select>
                                            </div>
                                            <div class="col-4">
                                              <label class="small mb-1" for="rate">Rate per Day</label>
                                              <input class="form-control" type="text" id="rate" name="rate" placeholder="Rs" value="" autocomplete="off" required >
                                            </div>
                                          </div>
                                          <div class="row gx-5 mb-3">
                                            <div class="col-12">
                                              <label class="small mb-1" for="details">Details</label>
                                              <textarea class="form-control" name="details" id="details" cols="30" rows="6" autocomplete="off"></textarea>
                                            </div>
                                          </div>
                                        </div>
                          </div>
                          <div class="modal-footer">
                              <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                              <input type="submit" class="btn btn-success" name="submit" >
                          </div>
                      </form>
                  </div>
              </div>
              </div>

        <!-- Booking Details table -->

          <div class="container">
            <div class="overflow-auto table-con">
            <table class="table custom-table">
              <thead class="table-sticky">
                <tr>
                  <th class="col-3">Booking <br />ID</th>
                  <th class="col-3">Renter</th>
                  <th class="col-3">phone</th>
                  <th class="col-3">email</th>
                  <th class="col-3">Vehicle</th>
                  <th class="col-3">From</th>
                  <th class="col-3">To</th>
                  <th class="col-3">Status</th>
                  <th class="col-3">Amount</th>
                  <th class="col-3">Date</th>
                </tr>
              </thead>
              <tbody id="tableb">
                <?php
                 $output = '';
                 while ($udetails = $ud->fetch(PDO::FETCH_ASSOC)) {
                   $datef = new DateTime($udetails['fromdate']);
                   $datet = new DateTime($udetails['todate']);
                   $dateb = new DateTime($udetails['bdate']);
                   if($udetails['status']=='active'){
                     $status = '<span class="badge text-bg-success">Active</span>';
                   }elseif($udetails['status']=='upcoming'){
                     $status = '<span class="badge rounded-pill text-bg-warning">Upcoming</span>';
                   }else{
                     $status = '<span class="badge rounded-pill text-bg-secondary">Finished</span>';
                   }
                    $output.='<tr>
                       <td>'. $udetails['bookingid'] .'</td>
                       <td>'.$udetails['fname'] .' '.$udetails['lname'] .'</td>
                       <td>'.$udetails['phone'] .'</td>
                       <td>'.$udetails['email'] .'</td>
                       <td>'.$udetails['vbrand'] .' '.$udetails['vname'] .'</td>
                       <td>'.$datef->format('F d, Y').'</td>
                       <td>'.$datet->format('F d, Y').'</td>
                       <td>'.$status.'</td>
                       <td>'.$udetails['total'].'</td>
                       <td>'.$dateb->format('F d, Y').'</td>
                     </tr>';
                   }
                   echo $output;
                 ?>
              </tbody>
            </table>
            </div>
      </div>
      </div>
      <?php } ?>

    </div>
  </div>
   <?php include 'footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/user.js"></script>
</body>

</html>
