<?php
session_start();

include '7_StaffClass.php'; //Admin Class


echo "<form action = '6_StaffPage.php?<?php echo SID;?>' method ='POST'>
<input type='submit' name='back' value='Back'>
</form>";
echo "Student Display Page";


$StudentRecord=new Staff();
if (isset($_GET['StudentSessionID'])) {
    $StudentSessionID = $_GET['StudentSessionID'];
	
	
	$StudentRecord->IndividualStudentRecord($StudentSessionID);
	
	
} else {
    die("StudentSessionID not provided in the URL");
}	






?>