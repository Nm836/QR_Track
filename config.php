
<?php
$db_host = 'tcp:qrtrack-server.database.windows.net,1433';
$db_name = 'qrtrack_sample';
$db_user = 'NimitM';
$db_pass = 'Capstone@123';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>