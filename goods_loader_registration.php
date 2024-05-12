<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database (replace these variables with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = ""; // If you have a password, enter it here
    $dbname = "logistics_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO goods_loader (username, password, email, full_name, address, phone_number, vehicle_type, license_plate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $username, $password, $email, $fullName, $address, $phoneNumber, $vehicleType, $licensePlate);

    // Set parameters and execute
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $email = $_POST['email'];
    $fullName = $_POST['full_name'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone_number'];
    $vehicleType = $_POST['vehicle_type'];
    $licensePlate = $_POST['license_plate'];

    if ($stmt->execute()) {
        header("Location: successful.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goods Loader Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            background-image:url('images/goods_reg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            max-width: 800px; /* Increased width for larger screens */
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            outline: 0;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-block {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Goods Loader Registration</h2>
        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="full_name">Full Name:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                </div>
            </div>
            <!-- Additional fields for goods loader details -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="vehicle_type">Vehicle Type:</label>
                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type">
                </div>
                <div class="form-group col-md-6">
                    <label for="license_plate">License Plate:</label>
                    <input type="text" class="form-control" id="license_plate" name="license_plate">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
