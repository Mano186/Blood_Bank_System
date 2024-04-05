<?php
include('includes/db_connection.php');
include('includes/functions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }

        .blood-header {
            background-color: #c82333;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 30px;
        }

        .blood-header h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .blood-box {
            border: 2px solid #c82333;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .blood-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .blood-btn {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
            margin: 10px;
            padding:10px;
            padding-left:20px;
            padding-right:20px;

        }
        .bloody{
            display:flex;
            justify-content:space-around;
        }

        .blood-btn:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row blood-header">
            <div class="col">
                <h2>Hospital Registration</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="blood-box">
                    <form action="register_hospital.php" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="hidden" name="user_role" value="hospital">
                            <label for="hospital_name">Hospital Name:</label>
                            <input type="text" class="form-control" id="hospital_name" name="hospital_name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <input type="checkbox" onclick="togglePassword()">Show Password
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="bloody">
                            <button type="submit" class="btn blood-btn">Register</button>
                            <a href="login.php" class="btn blood-btn">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                alert("Password and Confirm Password must match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>



<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_role = $_POST['user_role'];
    $hospital_name = $_POST['hospital_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // Register hospital
    if (register_hospital($user_role, $hospital_name, $username, $password)) {
        echo "<script>alert('Hospital registered successfully');</script>";
    } else {
        echo "<script>alert('Error in registration');</script>";
    }
}
?>