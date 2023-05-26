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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Ubuntu:wght@300;400;500;700&display=swap" rel=" stylesheet">

  <script src="https://kit.fontawesome.com/c216237aa3.js" crossorigin="anonymous"></script>

  <link href="assets/css/thememin.css" rel="stylesheet">
  <link href="assets/css/search.css" rel="stylesheet">

</head>
  <body>
     <?php include 'navbar.php'; ?>
     <div class="s011">
       <form method="POST" action="car-listing.php">
         <fieldset>
           <legend>Search Vehicles</legend>
         </fieldset>
         <div class="inner-form">
           <header>
             <div class="travel-type-wrap">


               <div class="item">
                 <div class="group-icon">
                 </div>
                 <span>CAR</span>
               </div>
               <div class="item">
                 <div class="group-icon">
                 </div>
                 <span>BIKE</span>
               </div>
             </div>
           </header>
           <div class="main-form" id="main-form">
             <div class="row">
               <div class="input-wrap">
                 <div class="icon-wrap">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                   </svg>
                 </div>
                 <div class="input-field">
                   <label>Starting</label>
                   <input type="text" name="location" placeholder="Location state/city/town" />
                 </div>
               </div>
             </div>
             <div class="row second">

               <div class="input-wrap">
                 <div class="icon-wrap">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
                   </svg>
                 </div>
                 <div class="input-field">
                   <label>Start Date</label>
                   <input class="datepicker" type="text" name="startdate" placeholder="yyyy/mm/dd" />
                 </div>
               </div>
               <div class="input-wrap">
                 <div class="icon-wrap">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
                   </svg>
                 </div>
                 <div class="input-field">
                   <label>End Date</label>
                   <input class="datepicker" type="text" name="enddate" placeholder="yyyy/mm/dd" />
                 </div>
               </div>
             </div>
             <div class="row last">
               <button class="btn-search" id="vsrch" type="submit" name="" value="" >Search</button>
             </div>
           </div>
         </div>
       </form>
     </div>
     <script src="assets/js/extention/choices.js"></script>
     <script>
       const choices = new Choices('[data-trigger]',
       {
         searchEnabled: false,
         itemSelectText: '',
       });

     </script>
     <script src="assets/js/extention/flatpickr.js"></script>
     <script>
       flatpickr(".datepicker",
       {
         dateFormat: "Y-m-d"
       });
       var btnTypes = document.querySelectorAll('.travel-type-wrap .item')
       var mainForm = document.getElementById('main-form')
       var srch = document.getElementById('vsrch')
       for (let i = 0; i < btnTypes.length; i++)
       {
         btnTypes[i].addEventListener('click', function()
         {
           for (let i = 0; i < btnTypes.length; i++)
           {
             btnTypes[i].classList.remove('active')
           }
           btnTypes[i].classList.add('active')
           let className = 'type' + i
           mainForm.className = `${className} main-form`
           srch.value = 'submit' + i
           srch.name = 'submit' + i
         })
       }

     </script>

     <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="assets/js/theme.js"></script>
  </body>
</html>
