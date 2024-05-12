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
            background-image:url('images/role_reg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
    max-width: 400px;
    margin: 100px auto;
    padding: 30px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 20px 0 rgba(0, 123, 255, 0.5); /* Adjust the color and spread radius for the glow effect */
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registrationForm" method="POST">
            <div class="form-group">
                <label for="role">Select Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="" selected disabled>Select Role</option>
                    <option value="client">Client</option>
                    <option value="goods_loader">Goods Loader</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').submit(function(event) {
                var role = $('#role').val();
                
                switch(role) {
                    case 'client':
                        window.location.href = 'client_registration.php';
                        break;
                    case 'goods_loader':
                        window.location.href = 'goods_loader_registration.php';
                        break;
                    default:
                        // Handle unrecognized role
                        alert('Please select a valid role.');
                        break;
                }
                
                event.preventDefault(); // Prevent default form submission
            });
        });
    </script>
</body>
</html>
