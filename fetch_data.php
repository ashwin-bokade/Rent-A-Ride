<?php

  include 'assets/php/_dbconnect.php';
  session_start();

  if(isset($_POST["action"]))
  {
    $output ='';
    $pick=$conn->prepare('SELECT `bid` FROM `business` WHERE `state`= ? or `city`= ? ');
    $pick->execute([$_SESSION['location'],$_SESSION['location']]);
    while ($bd = $pick->fetch(PDO::FETCH_ASSOC)) {

    $query ="SELECT * from `show_v` where `bid`=? and `type` = ?";

    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	  {
		   $query .= "
		     AND rate BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		   ";
	  }
    if(isset($_POST["variant"])){
      $variant_filter = implode("','", $_POST["variant"]);
	  	$query .= "
		    AND variant IN('".$variant_filter."')
		  ";
    }
    if(isset($_POST["fuel"])){
      $fuel_filter = implode("','", $_POST["fuel"]);
	  	$query .= "
		    AND fuel IN('".$fuel_filter."')
		  ";
    }
    if(isset($_POST["trans"])){
      $trans_filter = implode("','", $_POST["trans"]);
	  	$query .= "
		    AND trans IN('".$trans_filter."')
		  ";
    }


    if(isset($_POST["sort"])){

        if(in_array('asc',$_POST["sort"])){
        $query .= " ORDER BY rate ASC, vbrand ASC, vname ASC";
      }
      elseif(in_array('desc',$_POST["sort"])){
        $query .= " ORDER BY rate DESC,vbrand ASC, vname ASC";
      }

    }

    $stmt = $conn->prepare($query);

    $stmt->execute([$bd['bid'], $_SESSION['type']]);
    $vehicles = $stmt->fetchAll();
    $total_row = $stmt->rowCount();


    if(!empty($vehicles)){

     foreach($vehicles as $vehicles){
       $star='';
       for ($i = 1; $i <= 5 ; $i++) {
         if($i <=  $vehicles['rating'])
           $star .= '<i class="fa fa-star"></i>';
        else
           $star .= '<i class="fa fa-star grey"></i>';
         }

$output.='
<div class="card">
 <div class="img-section">
   <img src="'.$vehicles['imgurl'].'" class="product-img">
 </div>
   <div class="product-desc">
     <span class="product-title">
         '.$vehicles['vbrand'].' '. $vehicles['vname'].'
        <br /><span class="badge">
         '.$vehicles['variant'].'
        </span>
     </span>
     <span class="product-caption">
        '.$vehicles['vbrand'].'
     </span>
     <span class="product-rating">
         '.$star.'
     </span>
   </div>
   <div class="product-properties">
     <span class="transmission">
       <h4>'.$vehicles['fuel'].' ,   '.$vehicles['trans'].'</h4>
     </span>

     <span class="product-rent">
       Rs<b> '.$vehicles['rate'].'</b>/Month
     </span>
   </div>
</div>
  ';
 }

}}
echo $output;
}
 ?>
