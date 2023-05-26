<?php
include_once('config.php');
include 'connect.php';

// $google_client->revokeToken();
session_start();
session_unset();
session_destroy();

header('location:index.php');

?>
