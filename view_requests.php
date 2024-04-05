<?php
include('includes/session.php');
include('includes/db_connection.php');

if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

$hospital_id = $_SESSION['user_id'];

// Fetch requests with receiver information
$sql = "SELECT rcv.receiver_name, bs.blood_group, r.request_date
        FROM requests r
        JOIN receivers rcv ON r.receiver_id = rcv.receiver_id
        JOIN blood_samples bs ON r.sample_id = bs.sample_id
        WHERE bs.hospital_id = '$hospital_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Requests</title>
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

        .blood-table th, .blood-table td {
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
                <h2>View Requests</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="blood-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Receiver Name</th>
                                <th>Blood Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>".$row['receiver_name']."</td><td>".$row['blood_group']."</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No requests found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
