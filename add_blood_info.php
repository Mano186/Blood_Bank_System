<?php
include('includes/session.php');
include('includes/db_connection.php');

if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital_id = $_SESSION['user_id'];
    $blood_group = $_POST['blood_group'];
    $quantity = $_POST['quantity'];
    
    // Add blood info
    $sql = "INSERT INTO blood_samples (hospital_id, blood_group, quantity) VALUES ('$hospital_id', '$blood_group', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        $message = "Blood info added successfully";
    } else {
        $error = "Error adding blood info";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blood Info</title>
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

        .blood-btn:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .btn-danger{
            font-size:12px;
            margin:20px;
            margin-left:0;
        }
        .mybuttons{
            display : flex;
            flex-direction:column;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row blood-header">
            <div class="col">
                <h2>Add Blood Info</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="blood-box">
                    <?php if (isset($message)) { ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php } ?>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>
                    <!-- Logout Button -->
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                    
                    <form action="add_blood_info.php" method="post">
                        <div class="form-group">
                            <label for="blood_group">Blood Group:</label>
                            <input type="text" class="form-control" id="blood_group" name="blood_group" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                       <div class="mybuttons">
                        <button type="submit" class="btn blood-btn">Add Blood Info</button>
                            <a href="available_samples.php" class="btn blood-btn">Available Samples</a>
                            <a href="view_requests.php" class="btn blood-btn">View Requests</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
