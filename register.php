<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .custom-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle, #7fdbda, #007bff);
            opacity: 0.5;
            z-index: -1;
        }
        .container {
            position: relative;
            max-width: 500px;
            margin-top: 50px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            background-color: #fff;
            backdrop-filter: blur(10px); /* Apply blur effect */
        }
        h2 {
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            border-radius: 20px;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .alert {
            border-radius: 20px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="custom-background"></div>
    <div class="container">
        <h2>Register</h2>
        <form id="registrationForm" action="registration_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="" selected disabled>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="client">Client</option>
                    <option value="loader">Goods Loader</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div id="registrationMessage" class="alert d-none"></div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').submit(function(event) {
                var username = $('#username').val();
                var password = $('#password').val();
                var role = $('#role').val();
                
                if (!username || !password || !role) {
                    event.preventDefault(); // Prevent form submission
                    $('#registrationMessage').removeClass('d-none').addClass('alert-danger').text('Please fill in all fields.');
                }
            });
        });
    </script>
</body>
</html>
