<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/index.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.5); /* Adjust the opacity for the blur effect */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px); /* Apply blur effect */
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"],
        select {
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
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Logistics System</h1>
        <h2>Login</h2>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="role" required>
                <option value="client">Client</option>
                <option value="goods_loader">Goods Loader</option>
                <option value="admin">Admin</option>
            </select><br>
            <input type="submit" value="Login">
        </form>
        <h2>Register</h2>
        <p>New user? <a href="role_reg.php">Register Here</a></p>
    </div>

    <?php
session_start();

// Your database connection and other configurations

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the $_POST variables are set
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
        // Connect to your database (replace these variables with your database credentials)
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

        // Set parameters
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Prepare and bind parameters for user authentication
        $stmt = $conn->prepare("SELECT * FROM $role WHERE username = ?");
        $stmt->bind_param("s", $username);

        // Execute user authentication query
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                // Fetch the user row
                $row = $result->fetch_assoc();
                
                // Verify hashed password
                if (password_verify($password, $row['password'])) {
                    // Authentication successful
                    $_SESSION['authenticated'] = true; // Set session variable
                    $_SESSION['role'] = $role; // Set role in session
                    switch ($role) {
                        case 'client':
                            header("Location: client_dashboard.php");
                            exit();
                        case 'goods_loader':
                            header("Location: goods_loader_dashboard.php");
                            exit();
                        case 'admin':
                            header("Location: admin_dashboard.php");
                            exit();
                        default:
                            // Handle unrecognized role
                            header("Location: index.php"); // Redirect to login page
                            exit();
                    }
                } else {
                    // Password does not match
                    echo "An error occurred. Please try again later.";
                }
            } else {
                // User not found
                echo "An error occurred. Please try again later.";
            }
        } else {
            // Query execution failed
            echo "An error occurred. Please try again later.";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } 
} 
?>
