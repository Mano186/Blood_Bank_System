<?php 
include('includes/db_connection.php'); 
include('includes/session.php');

// Redirect user to dashboard if already logged in
if (is_logged_in()) {
    if ($_SESSION['user_role'] == 'hospital') {
        header("Location: add_blood_info.php");
        exit();
    } elseif ($_SESSION['user_role'] == 'receiver') {
        header("Location: available_samples.php");
        exit();
    }
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Sanitize user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    // Query to fetch user details based on username and role
    $sql = "SELECT hospital_id AS user_id, username, password, 'hospital' AS user_role FROM hospitals WHERE username = '$username' 
            UNION 
            SELECT receiver_id AS user_id, username, password, 'receiver' AS user_role FROM receivers WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User found, verify password and role
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, create session and redirect based on role
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_role'] = $row['user_role'];
            if ($_SESSION['user_role'] == 'hospital') {
                header("Location: add_blood_info.php");
                exit();
            } elseif ($_SESSION['user_role'] == 'receiver') {
                header("Location: available_samples.php");
                exit();
            }
            
        } else {
            // Incorrect password
            $error = "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        $error = "User with provided username does not exist.";
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
                <h2>User Login</h2>
            </div>
        </div>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="blood-box">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-block blood-btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>