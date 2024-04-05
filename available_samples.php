<?php
include('includes/session.php');
include('includes/db_connection.php');

// Redirect to login page if not logged in
if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

// Fetch available blood samples
$sql = "SELECT * FROM blood_samples";
$result = $conn->query($sql);

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
    <title>Available Blood Samples</title>
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

        .blood-table {
            border: 2px solid #c82333;
            border-radius: 10px;
            background-color: #ffffff;
        }

        .blood-table th,
        .blood-table td {
            border: 1px solid #dee2e6;
            padding: 10px;
        }

        .blood-table th {
            background-color: #c82333;
            color: #ffffff;
        }

        .btn-danger {
            margin: 10px;
            width: 40%;
            font-size: 15px;
        }

        #mybutton {
            margin: 30px;
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row blood-header">
            <div class="col">
                <h2>Available Blood Samples</h2>
            </div>
        </div>
        
        <!-- Blood samples table -->
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="blood-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sample ID</th>
                                <th>Hospital ID</th>
                                <th>Blood Group</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>".$row['sample_id']."</td><td>".$row['hospital_id']."</td><td>".$row['blood_group']."</td><td>".$row['quantity']."</td>";
                                    
                                    // Check if user is a receiver, then display the request button
                                    if ($_SESSION['user_role'] == 'receiver') {
                                        echo "<td><a href='request_sample.php?sample_id=".$row['sample_id']."' class='btn btn-primary'>Request</a></td></tr>";
                                    } else {
                                        echo "<td>Not available</td></tr>";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='5'>No blood samples available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Logout form -->
        <form action="available_samples.php" method="post" style="margin-bottom: 10px;">
            <div class="row justify-content-center">
                <div class="col-6" id="mybutton">
                    <button type="submit" name="logout" class="btn btn-danger btn-block">Logout</button>
                    
                </div>
            </div>
        </form>
    </div>
</body>
</html>
