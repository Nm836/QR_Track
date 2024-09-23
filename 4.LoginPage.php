<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Track LogIn/Register</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1, h2 {
            text-align: center;
            color: #0073e6;
        }

        h3 {
            margin-bottom: 15px;
            color: #005bb5;
        }

        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px solid #ddd;
        }

        .container {
            background: white;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        input[type="reset"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #0073e6;
            color: white;
            cursor: pointer;
            border: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #005bb5;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        p {
            margin-bottom: 15px;
            color: #666;
        }

        em {
            font-size: 0.9em;
            color: #999;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>QR Track</h1>
        <h2>Register / Log In</h2>
        <p>Staff and Students should first Register</p>
        <hr />

        <h3>New Registration (Sign Up)</h3>
        <form method="post" action="5.1_Registration.php">
            <div class="form-group">
                <label>Enter your name:</label>
                <input type="text" name="first" placeholder="First Name" required />
                <input type="text" name="last" placeholder="Last Name" required />
            </div>

            <div class="form-group">
                <label>Phone Number <i><small>(10 Digits)</small></i>:</label>
                <input type="text" name="phone" placeholder="Phone Number" required />
            </div>

            <div class="form-group">
                <label>Type of authorization:</label>
                <input type="radio" name="type" value="Student" checked /> Student
                <input type="radio" name="type" value="Staff" /> Staff
            </div>

            <div class="form-group">
                <label>Enter Staff/Student ID <i><small>(6 Digits)</small></i>:</label>
                <input type="text" name="id" placeholder="ID" required />
            </div>

            <div class="form-group">
                <label>Enter your email address:</label>
                <input type="text" name="email" placeholder="Email Address" required />
            </div>

            <div class="form-group">
                <label>Enter a password for your account:</label>
                <input type="password" name="password1" placeholder="Password" required />
            </div>

            <div class="form-group">
                <label>Confirm your password:</label>
                <input type="password" name="password2" placeholder="Confirm Password" required />
            </div>

            <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>

            <input type="reset" name="reset" value="Reset Registration Form" />
            <input type="submit" name="register" value="Register" />
        </form>
        <hr />

        <h3>Returning Student/Staff (Sign In)</h3>
        <form method="post" action="5.2_VerifyLogin.php">
            <div class="form-group">
                <label>Enter your Student/Staff ID:</label>
                <input type="text" name="Student_Staff_ID" placeholder="ID" required />
            </div>

            <div class="form-group">
                <label>Enter your password:</label>
                <input type="password" name="passwordLogin" placeholder="Password" required />
            </div>

            <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>

            <input type="reset" name="reset" value="Reset Login Form" />
            <input type="submit" name="login" value="Log In" />
        </form>
    </div>

</body>
</html>
