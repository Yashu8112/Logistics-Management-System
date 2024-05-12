<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .success-message {
            color: green;
            margin-top: 20px;
        }
        .error-message {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $conn = new mysqli('localhost', 'root', '', 'logistics_db');

            $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
            if ($conn->query($query) === TRUE) {
                echo "<h2>Registration Successful</h2>";
                echo "<p class='success-message'>Thank you for registering, $username!</p>";
            } else {
                echo "<h2>Error</h2>";
                echo "<p class='error-message'>Error: " . $query . "<br>" . $conn->error . "</p>";
            }
            $conn->close();
        } else {
            // If accessed directly without POST request
            echo "<h2>Error</h2>";
            echo "<p class='error-message'>Direct access not allowed.</p>";
        }
        ?>
    </div>
</body>
</html>
