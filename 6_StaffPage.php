<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - QR Track</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        main {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 20px;
            color: #343a40;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #343a40;
        }

        input[type="text"] {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .logout-button {
            float: right;
            padding: 8px 16px;
            background-color: #dc3545;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .alert {
            color: #dc3545;
        }

    </style>
</head>
<body>
    <header>
        <h1>Staff Dashboard - QR Track 
            <form action='4.LoginPage.php' method='POST' style="display:inline;">
                <input type='submit' name='logout' value='Log Out' class="logout-button">
            </form>
        </h1>
    </header>

    <main>
        <?php
        $userID = $_SESSION['userid']; //User id

        include '7_StaffClass.php'; //Admin Class
        $StaffView = new Staff();
        $StaffView->nameHeader($userID);
        ?>

        <h3>Search & Manage Attendance</h3>
        <form action="6_StaffPage.php" method="POST">
            <label for="keywords">Search Student by keywords:</label>
            <input type='text' name="keywords" placeholder="Enter student name or ID...">
            <input type='submit' name='keywordsearch' value='Search'>
            <br /><br />

            <h3>Enrolled Student Data</h3>
            <input type='submit' name='listAll' value='View All Students'>
            <input type='submit' name='QRCodeGenerator' value='Generate QR Code'>
        </form>

        <?php
        // Display all student data or search result
        if (isset($_POST['listAll']) || isset($_POST['back'])) {
            $PercentageDisplay = $StaffView->AttendancePercentage();
            $StaffView->displayAttendancePercentage($PercentageDisplay);
        }

        // Keyword search logic
        if (isset($_POST['keywordsearch'])) {
            if (!empty($_POST['keywords'])) {
                $keywords = $_POST['keywords'];
                $keywords = stripcslashes($keywords);
                $keywords = trim($keywords);
                
                if ($keywords == "") {
                    $StaffView->AttendancePercentage();
                } else {
                    $StaffView->searchfunction($keywords);
                }
            } else {
                echo "<p class='alert'>Please enter valid search keywords.</p>";
            }
        }
        ?>
    </main>
</body>
</html>
