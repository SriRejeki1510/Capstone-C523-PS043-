<?php
// Database connection
 $servername = "localhost";
$database = "kelasmm3_capstonemm3";
$username = "kelasmm3_capstonemm3";
$db_password = "A{x4Ne[^0t@x";
$conn = mysqli_connect($servername, $username, $db_password, $database);

// CHECK DATABASE CONNECTION
if($db_connection->error){
    echo "Connection Failed - ".$db_connection->connect_error;
    exit;
}   

