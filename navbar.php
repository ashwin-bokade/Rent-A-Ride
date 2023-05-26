<?php
    $up = "assets/img/user.png";
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE uno = ?");
    $select_profile->execute([$user_id]);
    $row= $select_profile->rowCount();
    if($row > 0){
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      $up = $fetch_profile['p_url'];
      if($fetch_profile['role']=='owner'){
        $b_profile = $conn->prepare("SELECT bid FROM `business` WHERE uno = ?");
        $b_profile->execute([$user_id]);
        $r=$b_profile->fetch(PDO::FETCH_ASSOC);
        $_SESSION['b_id'] = $r['bid'];
      }
    }
?>
<script>var user= <?php echo isset($_SESSION['user_id']) ? 'true' : 'false';?>;</script>

    <div class="header">
      <nav class="navbar navbar-expand-lg navbar-dark navbar-inverse navd">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Rent-a-Ride</a>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a href="about.php">How it Works</a>
              </li>
              <?php
                 if(isset($_SESSION['b_id'])){
                  echo" <li class='nav-item'>
                     <a href='user.php'>Manage</a>
                   </li>";
                 }else{
                   echo"<li class='nav-item'>
                     <a href='owner.php'>Partner Us</a>
                   </li>";
                 }
               ?>
              <li class="nav-item">
                <a href="contact.php">Contact Us</a>
              </li>
              <li class="nav-item Login">
                <a href="login.php">Login/Sign up</a>
              </li>
            </ul>
            <div class="nav-item img-box dropdown-center">
              <button class="btn btn-dark" type="button" id="userDropdown" data-bs-toggle="dropdown" >
              <a href="user.php" class="user d-flex align-items-center"><img src="<?php  echo $up; ?>" alt="profile-photo"><div class="uname"><?php if($row > 0){echo $fetch_profile['fname'];}?></div></a>
              </button>
              <div class="dropdown-menu">
                <a href="user.php"  class="dropdown-item profile" >Profile</a>
                <a href="login.php" class="dropdown-item d-none signup vis">Login/Sign up</a>
                <a href="about.php " class="dropdown-item d-none vis">How it Works</a>
               <?php
                if(isset($_SESSION['b_id'])){
                  echo"<a href='car-listing.php' class='dropdown-item d-none vis'>Manage</a>";
                }else{
                  echo"<a href='car-listing.php' class='dropdown-item d-none vis'>Partner Us</a>";
                }
                ?>
                <a href="contact.php " class="dropdown-item d-none vis">Contact Us</a>
                <a href="logout.php" class="dropdown-item logout" onclick="return confirm('logout from this website?');">Logout</a>
             </div>
            </div>

        </div>
      </nav>
    </div>
