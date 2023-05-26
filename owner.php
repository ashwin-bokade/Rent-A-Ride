<?php

  include 'assets/php/_dbconnect.php';

  session_start();

  if(isset($_SESSION['user_id'])){
     $user_id = $_SESSION['user_id'];
     if(isset($_SESSION['b_id'])){
       $b_id = $_SESSION['b_id'];
       header('location: index.php');
     }else{
       $b_id ='';
     }
  }else{
     header('location: login.php');
  }

  if (!is_writable('business-profile')) {
      chmod('business-profile',0777);
   }

 if (isset($_POST['submit'])) {

   $bname=$_POST['bname'];
   $bname = filter_var($bname, FILTER_SANITIZE_STRING);

   $bphone=$_POST['bphone'];
   $bphone = filter_var($bphone, FILTER_SANITIZE_NUMBER_INT);

   $bemail=$_POST['bemail'];
   $bemail = filter_var($bemail, FILTER_SANITIZE_EMAIL);

   $baddress = $_POST['baddress'];
   $baddress = filter_var($baddress, FILTER_SANITIZE_STRING);

   $city =$_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $state=$_POST['state'];
   $state = filter_var($state, FILTER_SANITIZE_STRING);


   $select_user = $conn->prepare("SELECT * FROM `users` WHERE `uno` = ? and `role` = 'owner' ");
   $select_user->execute([$user_id]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      echo "<script> alert('You are already registered !'); </script>";
   }else{
     if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
       $info = getimagesize($_FILES['image']['tmp_name']);
         if ($info !== false) {
       $existingPhoto = 'business-profile/photo-'. $user_id .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
       if (file_exists($existingPhoto)) {
         unlink($existingPhoto);
       }
       $bp_url = 'business-profile/'. $user_id .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
       move_uploaded_file($_FILES['image']['tmp_name'], $bp_url);
       }
      }
     $insert_user = $conn->prepare("INSERT INTO `business` (`uno`, `bname`, `baddress`, `bphone`, `bemail`, `bp_url`, `state`, `city`, `date`) VALUES (?,?,?,?,?,?,?,?,current_timestamp())");
     $insert_user->execute([$user_id, $bname, $baddress, $bphone, $bemail, $bp_url, $state, $city]);
     $select_user = $conn->prepare("UPDATE `users` SET `role` = 'owner' WHERE `uno` = ?");
     $select_user->execute([$user_id]);
     $select_user = $conn->prepare("SELECT * FROM `business` WHERE uno=?");
     $select_user->execute([$user_id]);
     $row = $select_user->fetch(PDO::FETCH_ASSOC);
     if($select_user->rowCount() > 0){
       $_SESSION['b_id'] = $row['bid'];
       header('location:index.php');
     }
   }

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
	<!-- STYLE CSS -->
    <link href="assets/css/thememin.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/owner.css">
</head>

<body>
  <?php include 'navbar.php'; ?>
	<div class="wrapper">
		<form method="post" id="wizard" enctype="multipart/form-data">
			<section>
				<h3>Business Details</h3>
				<div class="form-row">
					<div class="avatar-upload">
						<div class="avatar-edit">
							<input type="file" id="image" name="image">
							<label for="image"></label>
						</div>
						<div class="avatar-preview">
							<div id="imagePreview" style="background-image: url('http://i.pravatar.cc/500?img=7');">
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-col">
						<label for="">
							<i class="fa-solid fa-user"></i>Business Name
						</label>
						<div class="form-holder">
							<input type="text" class="form-control" id ="bname" name="bname" >
						</div>
					</div>

					<div class="form-col">
						<label for="">
							<i class="fa-solid fa-envelope"></i>Email ID
						</label>
						<div class="form-holder">
							<input type="text" class="form-control" id="bemail" name="bemail">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-col">
						<label for="">
						 <i class="fa-solid fa-phone"></i>Phone Number
						</label>
						<div class="form-holder">
							<input type="text" class="form-control" id="bphone" name="bphone">
						</div>
					</div>

					<div class="form-col">
						<label for="">
							<i class="fa-solid fa-house"></i>Business Address
						</label>
						<div class="form-holder">
							<input type="text" class="form-control" id="baddress" name="baddress">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-col">
						<label for="">
						 <i class="fa-solid fa-location-dot"></i>State
						</label>
						<div class="form-holder">
							<select class="form-control" id="state" name="state">
								<option value="Goa" class="option">Goa</option>
							</select>
						</div>
					</div>
					<div class="form-col">
						<label for="">
						 <i class="fa-solid fa-location-dot"></i>Town / City
						</label>
						<div class="form-holder">
							<select class="form-control" id="city" name="city">
								<option value="Margao" class="option">Margao</option>
							</select>
						</div>
					</div>
				</div>
				<!-- <div class="form-row">
					<div class="form-col">
						<label for="">
							ID Proof
						</label>
						<div class="form-holder">
							<input type="file" class="form-control" id="doc">

						</div>
					</div>
					<div class="form-col">
						<label for="">
							Password
						</label>
						<div class="form-holder password">
							<i class="zmdi zmdi-eye"></i>
							<input type="password" class="form-control">
						</div>
					</div>
				</div> -->
				<div class="form-row">
				<button  class="btn osubmit " name="submit">Submit</button>
		</div>
			</section>
		</form>
	</div>
   <?php include 'footer.php'; ?>

	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="assets/js/theme.js"></script>
	<script src="assets/js/owner.js"></script>

</body>

</html>
