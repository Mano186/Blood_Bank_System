<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank System</title>
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

        .blood-header h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .blood-header p {
            font-size: 18px;
            margin-bottom: 0;
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
    <div class="container-fluid">
        <div class="row blood-header">
            <div class="col">
                <h1>Welcome to Blood Bank System</h1>
                <p>Donate Blood, Save Lives</p>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-4 text-center">
                <div class="blood-box">
                    <h3>Hospital Registration</h3>
                    <a href="register_hospital.php" class="btn btn-lg btn-block blood-btn">Register</a>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center mt-3 mt-md-0">
                <div class="blood-box">
                    <h3>Receiver Registration</h3>
                    <a href="register_receiver.php" class="btn btn-lg btn-block blood-btn">Register</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-4 text-center">
                <div class="blood-box">
                    <h3>Login</h3>
                    <a href="login.php" class="btn btn-lg btn-block blood-btn">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
