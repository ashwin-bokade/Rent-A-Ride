<?php
include 'assets/php/_dbconnect.php';
session_start();
if(isset($_SESSION['b_id'])){
  $b_id = $_SESSION['b_id'];
}else{
  $b_id = "";
}

if(isset($_POST['mode']))
{

  if ($_POST['mode'] === 'add') {
  if (!is_writable('vehicle-img')) {
     chmod('vehicle-img',0777);
   }
    $brand  = $_POST['brand'];
    $name = $_POST['name'];
    $regno  = $_POST['regno'];
    $type   = $_POST['type'];
    $variant   = $_POST['variant'];
    $trans   = $_POST['trans'];
    $fuel   = $_POST['fuel'];
    $rate   = $_POST['rate'];
    $details = $_POST['details'];
    $v_url = null;


     $select_user = $conn->prepare("SELECT * FROM `vehicle` where `regno`=?");
     $select_user->execute([$regno]);
     $row = $select_user->fetch(PDO::FETCH_ASSOC);
     if($select_user->rowCount() > 0){
        echo "<script> alert('Registration Number is already added !'); </script>";
     }else{

       if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
         $info = getimagesize($_FILES['image']['tmp_name']);
           if ($info !== false) {
             $v_url = 'vehicle-img/'. uniqid('img_', true).mt_rand() .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

             while(file_exists($v_url)) {
                 $v_url = 'vehicle-img/'. uniqid('img_', true).mt_rand() .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
             }
         move_uploaded_file($_FILES['image']['tmp_name'], $v_url);
         }
        }
     $stmt = $conn->prepare("INSERT INTO `vehicle` (`bid`, `vbrand`, `vname`, `regno`, `type`, `trans`, `variant`, `fuel`, `rate`, `imgurl`, `details`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
     $stmt->execute([$b_id,$brand,$name,$regno,$type,$trans,$variant,$fuel,$rate,$v_url,$details]);
     echo json_encode(true);
    }
}

if ($_POST['mode'] === 'edit') {
  $regno  = $_POST['regno'];
  $select_user = $conn->prepare("SELECT * FROM `vehicle` where `regno`=?");
  $select_user->execute([$regno]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);
  echo json_encode($row);
}

if ($_POST['mode'] === 'update')
{
  if (!is_writable('vehicle-img')) {
     chmod('vehicle-img',0777);
   }
    $brand  = $_POST['brand'];
    $name = $_POST['name'];
    $regno  = $_POST['regno'];
    $type   = $_POST['type'];
    $variant   = $_POST['variant'];
    $trans   = $_POST['trans'];
    $fuel   = $_POST['fuel'];
    $rate   = $_POST['rate'];
    $details = $_POST['details'];



     $select_user = $conn->prepare("SELECT `imgurl` FROM `vehicle` where `regno`=?");
     $select_user->execute([$regno]);
     $row = $select_user->fetch(PDO::FETCH_ASSOC);
     if($select_user->rowCount() == 0){
        echo "<script> alert('Registration Number Not Found !'); </script>";
     }else{
       $v_url = $row['imgurl'];
       echo $v_url;
       if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
         $info = getimagesize($_FILES['image']['tmp_name']);
           if ($info !== false) {
            if($v_url!=null){
              if(file_exists($v_url)){
              unlink($v_url);
             }
            }
            $v_url = 'vehicle-img/'. uniqid('img_', true).mt_rand() .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            while(file_exists($v_url)) {
                $v_url = 'vehicle-img/'. uniqid('img_', true).mt_rand() .'.'. pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            }

         move_uploaded_file($_FILES['image']['tmp_name'], $v_url);
         }
        }

     $stmt = $conn->prepare("UPDATE `vehicle` SET `vbrand` = ?, `vname` = ?, `type` = ?, `trans` = ?, `variant` = ?, `fuel` = ?, `rate` = ?, `imgurl` = ?, `details` = ? WHERE `regno`= ? ");
     $stmt->execute([$brand,$name,$type,$trans,$variant,$fuel,$rate,$v_url,$details,$regno]);
     echo json_encode(true);
    }
}

if ($_POST['mode'] === 'delete')
{
    $regno  = $_POST['regno'];
    $select_user = $conn->prepare("SELECT `imgurl` FROM `vehicle` where `regno`=?");
    $select_user->execute([$regno]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if($row['imgurl']!=null){
      if(file_exists($row['imgurl'])){
      unlink($row['imgurl']);
     }
    }

    $select_v = $conn->prepare("DELETE FROM `vehicle` WHERE `regno`= ? ");
    $select_v->execute([$regno]);
    echo json_encode(true);
}
}
?>
