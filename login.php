<?php
session_start();
include "config/db_config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet">

    <style>
        /* Additional CSS styles */
        .container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
        }

        #myInput {
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            /* border: none; */
            border: 1px solid #ddd;
            background-color: #ddd;
        }

        #myInput:focus {
            outline: 3px solid #ddd;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            background-color: #ddd;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ddd;
            width: 360px;
            /* Set a specific width for the dropdown */
            max-width: 360px;
            /* Set maximum width for larger screens */
            overflow: auto;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
        .form-control
        {
            background-color: #ddd;
        }

        .img {
            text-align: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="img">
            <img
                src="https://glansa.com/wp-content/uploads/elementor/thumbs/gllogo-pl1l6bmjhmx3czxexrdpaod6usjyu1ohofup34yo3o.png">
        </div>
        <form id="loginForm" method="POST" action="config/functions.php">
            
                <div class="form-group">
                            <label for="inputDepartment" class="form-label">Department:</label>
                            <select class="form-select" name="inputDepartment" id="inputDepartment">
                                <option value="">Select Department</option>
                                <?php
                                // Fetch department names from the database
                                $query = "SELECT department_name FROM department";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['department_name'] . "'>" . $row['department_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

            <div class="form-group">
                <label for="email">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" name="login" class="btn btn-warning btn-block">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery (optional, if you need JS functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    
</body>

</html>