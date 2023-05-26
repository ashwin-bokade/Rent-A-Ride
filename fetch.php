<?php
session_start();
if(isset($_SESSION['b_id'])){
  $b_id = $_SESSION['b_id'];
}else{
  $b_id = "";
}
$dbDetails = array(
'host' => 'localhost',
'user' => 'root',
'pass' => '',
'db'   => 'rentaride'
);

$table = 'vehicle';

$primaryKey = 'regno';

$columns = array(
array( 'db' => 'regno', 'dt' => 0 ),
array( 'db' => 'vbrand',  'dt' => 1 ),
array( 'db' => 'vname',  'dt' => 2 ),
array( 'db' => 'type',  'dt' => 3 ),
array( 'db' => 'variant',  'dt' => 4 ),
array( 'db' => 'trans',  'dt' => 5 ),
array( 'db' => 'fuel',  'dt' => 6 ),
array( 'db' => 'rate',  'dt' => 7 ),
array( 'db' => 'rating',  'dt' => 8 ),
array(
'db'        => 'regno',
'dt'        => 9,
'formatter' => function( $d, $row ) {
return '<a href="javascript:void(0)" class="btn btn-edit" data-regno="'.$row['regno'].'" ><i class="fa-solid fa-pen-to-square "></i></a> <a href="javascript:void(0)" class="btn btn-delete ml-2" data-regno="'.$row['regno'].'"><i class="fa-solid fa-trash"></i></a>';
}
)
);
// Include SQL query processing class
require 'assets/php/ssp.class.php';
// Output data as json format
echo json_encode(
SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns, null, "bid = $b_id "));
?>
