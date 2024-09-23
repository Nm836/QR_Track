<?php
class Staff {

    private $conn;
	private $UID="";
	private $StudentListDisplay="";
	private $keyword="";
	private $StudentSessionID = "";
	function __construct() {
        include 'Inc_Connect.php';//Change to azure
        $this->conn = $conn;
   
    }

    public function nameHeader($UID) {
		if ($this->UID != $UID){
			$this->UID = $UID;
    try {
			
            $sql = "SELECT * FROM Login_Record WHERE Student_StaffId='{$UID}'";
            $userInfo = $this->conn->query($sql);
            while ($row = $userInfo->fetch_assoc()) {
                echo "<h2>Welcome " . ucfirst($row['FirstName']) . " " . ucfirst($row['LastName']) . " !</h2>";
            }
        } catch (mysqli_sql_exception $e) {
            die("Error : " . $e->getMessage());
        }
    }
	}
	
	public function displayAttendancePercentage($StudentAttendance){
			echo "<table border='1' width='90%'>
        <tr><th>Student ID</th>
        <th>Name</th>
        <th>Attendance Percentage</th>
        <th>Action Taken</th>
        <th>Send E-Mail</th>
        </tr>";
        
        while ($row = $StudentAttendance->fetch_assoc()) {
			
			$StudentSessionID = $row['StudentID'];
			echo "<tr><td align='center'><a href='8_StudentAttendanceRecord.php?StudentSessionID={$StudentSessionID}'>{$row['StudentID']}</a></td>
		
            <td align='center'>{$row['FullName']}</td>
			
            <td align='center'>{$row['AttendancePercentage']}%</td>
			
            <td align='center'>Warning email sent on Date :</td>
            
            <td align='center'>
			
			
			<form method='POST' action ='Email Sender.php?".SID."'>
            <input type='submit' name='select' value='Email'>
            <input type='hidden' name='PValue' value=''> <!--Define USer ID-->
            </form></td></tr>";
        }
        echo "</table>";
		
	}
    public function AttendancePercentage($StudentId=null) {
		
		try{
	
/*			$StudentAttendanceQuery ="SELECT 
				sar.StudentId AS StudentID,
				sar.Name AS FullName,
				round (COALESCE(
						(COUNT(DISTINCT CASE 
                         WHEN sar.AttendanceNum = 'P1' 
                              AND EXISTS (SELECT 1 
                                          FROM Student_Attendance_Record sar2 
                                          WHERE sar2.StudentId = sar.StudentId 
                                          AND sar2.LectureWeek = sar.LectureWeek 
                                          AND sar2.AttendanceNum = 'P2')
                         THEN sar.LectureWeek 
                         END) 
						/ MAX(sar.LectureWeek)) * 100, 
							0
							),0) AS AttendancePercentage
							FROM Student_Attendance_Record sar";*/
							$StudentAttendanceQuery ="SELECT 
    StudentId AS StudentID, 
    Name as FullName, 
    round((SUM(CASE WHEN AttendanceNum = 'Present' THEN 1 ELSE 0 END) / 5) * 100) AS AttendancePercentage
FROM 
    Student_Attendance_Record";
		
							if ($StudentId!==Null){
								
							$StudentAttendanceQuery .= " WHERE 
		StudentId = {$StudentId}
    ";
							} 
							
						$StudentAttendanceQuery .= "	
						GROUP BY 
    StudentId, Name";
            $StudentAttendance = $this->conn->query($StudentAttendanceQuery);
			return $StudentAttendance;
			//$this->displayAttendancePercentage($StudentAttendance);
			
		}catch (mysqli_sql_exception $e) {
            die("Error : " . $e->getMessage());
        }	
        
    }


	public function displayAttendancePercentageSearch($StudentAttendance){
			
        while ($row = $StudentAttendance->fetch_assoc()) {
			$StudentSessionID = $row['StudentID'];
			echo "<tr><td align='center'><a href='8_StudentAttendanceRecord.php?StudentSessionID={$StudentSessionID}'>{$row['StudentID']}</a></td>

            <td align='center'>{$row['FullName']}</td>
			
            <td align='center'>{$row['AttendancePercentage']}%</td>
			
            <td align='center'>Warning email sent on Date :</td>
            
            <td align='center'>
			
			
			<form method='POST' action ='Email Sender.php?".SID."'>
            <input type='submit' name='select' value='Email'>
            <input type='hidden' name='PValue' value=''> <!--Define USer ID-->
            </form></td></tr>";
        }
        
		
	}

public function searchfunction($keyword){
		if ($this->keyword != $keyword){
		$this->keyword = $keyword;
		
		try {
			
            $SearchQuery = "SELECT Distinct StudentId FROM Student_Attendance_Record WHERE StudentId LIKE '%".$keyword."%' OR Name LIKE '%".$keyword."%'";
            $SearchResult = $this->conn->query($SearchQuery);
			if ($SearchResult->num_rows>0){
				
			
			echo "<table border='1' width='90%'>
        <tr><th>Student ID</th>
        <th>Name</th>
        <th>Attendance Percentage</th>
        <th>Action Taken</th>
        <th>Send E-Mail</th>
        </tr>";
        
        while ($row = $SearchResult->fetch_assoc()) {
			
			$StudentId = $row['StudentId'];
            $Percentage=$this->AttendancePercentage($StudentId);
			$this->displayAttendancePercentageSearch($Percentage);
        
        }
        echo "</table>";
			
				}
				
				
				
			 else echo "No Match Found";
			
        } catch (mysqli_sql_exception $e) {
            die("Error : " . $e->getMessage());
        }
		}
		
	}
	
public function IndividualStudentRecord($StudentSessionID){
try{
			$NameDisplayQuery="Select Distinct Name from  Student_Attendance_Record WHERE StudentId='{$StudentSessionID}'";
			$NameDisplay=$this->conn->query($NameDisplayQuery);
	            while ($row = $NameDisplay->fetch_assoc()) {
                echo "<h2>Student Name " . ucfirst($row['Name'])." </h2>";
				echo "<h2>Student ID " .$StudentSessionID." </h2>";
				}
////chnage code to add subcode information


	$WeekWiseAttendanceRecordQuery= "SELECT DISTINCT LectureWeek FROM Student_Attendance_Record WHERE StudentId='{$StudentSessionID}'";
	$WeekWiseAttendanceRecord=$this->conn->query($WeekWiseAttendanceRecordQuery);
	
	echo "<table border='1' width='90%'>
        <tr><th>Lecture Week</th>
        <th>Attendance Marked</th>
        
        
        </tr>";
    
	
	while ($row=$WeekWiseAttendanceRecord->fetch_assoc()){
		echo "<tr><td align='center'>{$row['LectureWeek']}</td>";
		
		
		$AttendanceCheckQueryP1="select AttendanceNum from Student_Attendance_Record where LectureWeek={$row['LectureWeek']} and StudentId={$StudentSessionID}";
		$AttendanceCheckP1=$this->conn->query($AttendanceCheckQueryP1);
		
		
		
	while ($row=$AttendanceCheckP1->fetch_assoc())	{
		
	echo "<td align='center'>{$row['AttendanceNum']}</td>";}
		
		
	}
		
	
	        echo "</table>";
}
 catch (mysqli_sql_exception $e) {
            die("Error : " . $e->getMessage());
        }
	
}

}



?>
