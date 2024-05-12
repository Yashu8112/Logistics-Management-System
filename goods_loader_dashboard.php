<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goods Loader Dashboard</title>
    <style>
        /* Styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image:url('images/goods_dash.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
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
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 22px); /* Adjusting width to accommodate the borders */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout input[type="submit"] {
            background-color: #dc3545;
        }
        .logout input[type="submit"]:hover {
            background-color: #c82333;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .navbar {
            text-align: center;
            margin-bottom: 20px;
        }
        .navbar a {
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            color: #333;
            background-color: #f4f4f4;
            border-radius: 5px;
        }
        .navbar a:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
     
        <h1>Goods Loader Dashboard</h1>
        <section id="verify-parcel">
            <h2>Verify Parcel</h2>
            <form action="" method="POST">
                <label for="parcel_id">Parcel ID:</label>
                <input type="text" id="parcel_id" name="parcel_id" placeholder="Parcel ID" required><br>
                <label for="cost">Cost:</label>
                <input type="number" id="cost" name="cost" placeholder="Cost" required><br>
                <label for="worth">Worth:</label>
                <input type="text" id="worth" name="worth" placeholder="Worth" required><br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Address" required><br>
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" placeholder="Pincode" required><br>
                <input type="submit" name="verify_submit" value="Verify">
            </form>
            <?php
            // PHP code for parcel verification
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_submit'])) {
                // Get the form data
                $parcel_id = $_POST['parcel_id'];
                $cost = $_POST['cost'];
                $worth = $_POST['worth'];
                $address = $_POST['address'];
                $pincode = $_POST['pincode'];

                // Connect to the database
                $conn = new mysqli("localhost", "root", "", "logistics_db");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and execute the query
                $stmt = $conn->prepare("SELECT * FROM parcels WHERE parcel_id = ? AND cost = ? AND worth = ? AND address = ? AND pincode = ?");
                $stmt->bind_param("sdsds", $parcel_id, $cost, $worth, $address, $pincode);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if the parcel exists
                if ($result->num_rows > 0) {
                    echo "<p style='color: green;'>Parcel Verified!</p>";
                } else {
                    echo "<p style='color: red;'>Parcel Not Verified!</p>";
                }

                // Close connections
                $stmt->close();
                $conn->close();
            }
            ?>
        </section>

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
