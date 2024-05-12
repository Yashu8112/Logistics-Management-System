<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image:url('images/admin_dash.jpg');
            background-repeat: no-repeat;
            background-size: cover;

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
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            text-align: center;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Dashboard</h2>

    <h3>Clients</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Registration Date</th>
        </tr>
    <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logistics_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query clients table
    $sql_clients = "SELECT * FROM client";
    $result_clients = $conn->query($sql_clients);

    if ($result_clients->num_rows > 0) {
        // Output data of each row
        while($row = $result_clients->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["username"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["full_name"]."</td>
                    <td>".$row["address"]."</td>
                    <td>".$row["phone_number"]."</td>
                    <td>".$row["registration_date"]."</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No clients found</td></tr>";
    }

    ?>
</table>

<h3>Goods Loaders</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Vehicle Type</th>
            <th>License Plate</th>
        </tr>
    <?php
    // Query goods_loaders table
    $sql_goods_loaders = "SELECT * FROM goods_loader";
    $result_goods_loaders = $conn->query($sql_goods_loaders);

    if ($result_goods_loaders->num_rows > 0) {
        // Output data of each row
        while($row = $result_goods_loaders->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["username"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["full_name"]."</td>
                    <td>".$row["address"]."</td>
                    <td>".$row["phone_number"]."</td>
                    <td>".$row["vehicle_type"]."</td>
                    <td>".$row["license_plate"]."</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No goods loaders found</td></tr>";
    }

    // Close connection
    $conn->close();
    ?>
</table>

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
