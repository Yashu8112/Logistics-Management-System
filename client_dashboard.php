<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: index.php"); // Redirect to login page
    exit(); // Stop further execution
}

// Prevent caching of the page
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-image:url('images/client_dash.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .logout-btn {
            text-align: center;
            margin-top: 20px;
        }
        .logout-btn button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-btn button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Parcel Information</h2>
        <form action="" method="POST">
            <input type="text" name="parcel_id" placeholder="Parcel ID" required><br>
            <input type="number" name="cost" placeholder="Cost" required><br>
            <input type="text" name="worth" placeholder="Worth" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="text" name="pincode" placeholder="Pincode" required><br>
            <input type="submit" name="submit" value="Generate QR Code">
        </form>

        <?php
        // Handle form submission
        if (isset($_POST['submit'])) {
            // Validate and sanitize input data
            $parcel_id = $_POST['parcel_id'];
            $cost = $_POST['cost'];
            $worth = $_POST['worth'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];

            // You can insert this data into your database here

            // Generate QR code
            $qr_content = "Parcel ID: $parcel_id\nCost: $cost\nWorth: $worth\nAddress: $address\nPincode: $pincode";
            $qr_image = 'qr_codes/' . $parcel_id . '.png'; // File path to save the QR code image

            // Include QR code library
            require_once 'phpqrcode/qrlib.php';

            // Generate QR code
            QRcode::png($qr_content, $qr_image, QR_ECLEVEL_L, 4);

            // Display QR code
            echo '<div class="qr-code">';
            echo '<h2>QR Code</h2>';
            echo '<img src="' . $qr_image . '" alt="QR Code">';
            echo '</div>';
        }
        ?>

        
<div class="logout-btn">
            <button onclick="logout()">Logout</button>
        </div>
    </div>

    <script>
        // Function to logout and redirect to login page
        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = 'index.php';
            }
        }
    </script>
</body>
</html>
<?php






// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $parcel_id = sanitize($_POST['parcel_id']);
    $cost = sanitize($_POST['cost']);
    $worth = sanitize($_POST['worth']);
    $address = sanitize($_POST['address']);
    $pincode = sanitize($_POST['pincode']);

    // Insert data into the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logistics_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare INSERT statement
    $stmt = $conn->prepare("INSERT INTO parcels (parcel_id, cost, worth, address, pincode) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsds", $parcel_id, $cost, $worth, $address, $pincode);
    

    // Execute the statement
    if ($stmt->execute()) {
        echo "Parcel information inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
