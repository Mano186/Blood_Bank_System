<?php
include('includes/session.php');
include('includes/db_connection.php');

if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['sample_id'])) {
        $receiver_id = $_SESSION['user_id'];
        $sample_id = $_POST['sample_id'];

        // Check if sample_id exists in blood_samples table
        $check_sql = "SELECT * FROM blood_samples WHERE sample_id = '$sample_id'";
        $result = $conn->query($check_sql);
        if($result->num_rows > 0) {
            // Add request
            $sql = "INSERT INTO requests (receiver_id, sample_id) VALUES ('$receiver_id', '$sample_id')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Request sent successfully');</script>";
            } else {
                echo "<script>alert('Error sending request');</script>";
            }
        } else {
            echo "<script>alert('Sample ID does not exist');</script>";
        }
    } else {
        echo "<script>alert('Sample ID not provided');</script>";
    }
    $conn->close();
}

// Logout logic
if (isset($_POST['logout'])) {
    logout(); // Call the logout function
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Sample</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        .blood-form {
            border: 2px solid #c82333;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .blood-form:hover {
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

        .blood-btn:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .btn-danger{
            margin:20px;
            width:40%;
            font-size:15px;
            margin-left:150px;       
}
    </style>
</head>
<body>
    <div class="container">
        <div class="row blood-header">
            <div class="col">
                <h2>Request Sample</h2>
            </div>
        </div>
        <!-- Logout form -->
      

        <!-- Request sample form -->
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="blood-form">
                    <form action="request_sample.php" method="post">
                    <div class="form-group">
                        <label for="sample_id">Sample ID:</label>
                        <input type="text" class="form-control" id="sample_id" name="sample_id" required>
                    </div>

                        <button type="submit" class="btn blood-btn">Request Sample</button>
                        
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <form action="request_sample.php" method="post" style="margin-bottom: 10px;">
            <div class="row justify-content-center">
                <div class="col-6">
                    <button type="submit" name="logout" class="btn btn-danger btn-block">Logout</button>
                </div>
            </div>
        </form>
</body>
</html>
