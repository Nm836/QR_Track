<?php
$servername="tcp:qrtrack-server.database.windows.net,1433";
$username="Nm836";
$password="Capstone@123";
$Databasename="qrtrack_sample";
try{
$conn= new mysqli($servername,$username,$password,$Databasename);
}
catch (mysqli_sql_exception $e) {
die("Connection Error : ".$e->getMessage());
}
?>
