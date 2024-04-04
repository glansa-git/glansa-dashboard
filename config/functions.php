<?php
// Server settings
session_start();

include "db_config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ("../vendors/PHPMailer/PHPMailer.php");
require ("../vendors/PHPMailer/SMTP.php");
require ("../vendors/PHPMailer/Exception.php");
$mail = new PHPMailer(true);

// Function to generate a hashed password
function generateRandomPassword($prefix)
{
    $chars = "0123456789";
    $password = $prefix; // Set the prefix
    $length = 4; // Length of the random number
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, $max)];
    }
    return $password;
}
// Function to send email with password
function sendEmail($to, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'soumya05ranjan@gmail.com'; //SMTP username
        $mail->Password = 'omxnmogdokgduolo'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


        // Email content
        $mail->setFrom('soumya05ranjan@gmail.com', 'Anita');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Handle user registration
if (isset($_POST['submit'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $password = generateRandomPassword("glansa");

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO registration (username, email, name, department, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $name, $department, $hashed_password);
    $stmt->execute();
    $stmt->close();

    // Send email with password
    $email_subject = "Your Account Information";
    $email_body = "Hello $name,<br><br>Your account has been successfully created.<br><br>Your username: $username<br>Your password: $password<br><br>Thank you!";
    if (sendEmail($email, $email_subject, $email_body)) {
        header("Location: ../login.php");
    } else {
        echo "Registration successful, but failed to send email.";
    }
}

// login Functionality

// login Functionality
// elseif (isset($_POST['login'])) {
//     $username = $_POST["username"];
//     $password = $_POST["password"]; // Don't escape the password
//     $inputDepartment = $_POST["inputDepartment"];

//     // Query to fetch user from database
//     $sql = "SELECT * FROM user WHERE name = '$username' and  department='$inputDepartment' ";
//     // echo "SQL Query: " . $sql . "<br>"; // Debugging: Output SQL query
//     $result = mysqli_query($conn, $sql);

//     if ($result && mysqli_num_rows($result) > 0) {
//         $user = mysqli_fetch_assoc($result);

//         // Verify the entered password against the hashed password stored in the database
//         if (password_verify($password, $user['password'])) {
//             // Store user information in session
//             $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the primary key of the user table
//             $_SESSION['name'] = $user['name'];
//             $_SESSION['role'] = $user['role'];

//             // Redirect to dashboard page
//             $_SESSION['status'] = 'success';
//             $_SESSION['message'] = 'Login successful!';
//             header("Location: ../admin/dashboard.php");
//             exit; // Make sure to exit after redirection
//         } else {
//             header("Location: ../login.php");
//             $_SESSION['status'] = 'danger';
//             $_SESSION['message'] = 'Invalid email or password!';
//         }
//     } else {
//         $_SESSION['status'] = 'danger';
//         $_SESSION['message'] = 'User not found!';
//     }
//     // Redirect back to login page in case of login failure
//     // header("Location: ../login.php");
//     // exit;
// }
elseif (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $inputDepartment = isset($_POST["inputDepartment"]) ? $_POST["inputDepartment"] : null; // Set inputDepartment to null if not selected

    // Query to fetch user from database
    if ($inputDepartment) {
        $sql = "SELECT * FROM user WHERE name = ? AND department = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $inputDepartment);
    } else {
        $sql = "SELECT * FROM user WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the entered password against the hashed password stored in the database
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['department'] = $user['department'];

            // Redirect to dashboard page
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Login successful!';
            header("Location: ../admin/dashboard.php");
            exit;
        } else {
            // Invalid password
            $_SESSION['status'] = 'danger';
            $_SESSION['message'] = 'Invalid email or password!';
            header("Location: ../login.php");
            exit;
        }
    } else {
        // User not found
        $_SESSION['status'] = 'danger';
        $_SESSION['message'] = 'User not found in the specified department!';
        header("Location: ../login.php");
        exit;
    }
} elseif (isset($_POST['submit_user'])) {
    // Retrieve form data
    $name = $_POST['inputName'];
    $department = $_POST['inputDepartment'];
    $mobile = $_POST['inputMobile'];
    $email = $_POST['inputEmail'];
    $empid = $_POST['inputEmpId'];
    $role = $_POST['inputrole'];

    // Generate a random password with prefix
    $password = generateRandomPassword("glansa");

    // Sanitize data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $department = mysqli_real_escape_string($conn, $department);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $email = mysqli_real_escape_string($conn, $email);
    $empid = mysqli_real_escape_string($conn, $empid);
    $role = mysqli_real_escape_string($conn, $role);
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Insert user data into the database
    $query = "INSERT INTO user (name, department, mobile, email, emp_id, password, role, created_at, created_by) VALUES ('$name', '$department', '$mobile', '$email', '$empid', '$password_hash', '$role', NOW(), '{$_SESSION['username']}')";
    $stmt = mysqli_query($conn, $query);
    if ($stmt) {
        // Send email with password
        $to = $email;
        $subject = "Account Information";
        $email_body = "Hello $name,<br><br>Your account has been successfully created.<br><br>Your EMP Id: $empid<br><br>Your username: $name<br>Your password: $password<br><br>Thank you!";

        if (sendEmail($to, $subject, $email_body)) {
            header("Location: ../admin/add_user.php");
        } else {
            echo "Registration successful, but failed to send email.";
        }
    }
} elseif (isset($_POST['update_user'])) {
    // Retrieve data from the form
    $id = $_POST['id']; // Get the user ID from the URL query parameter
    $name = $_POST['inputName'];
    $department = $_POST['inputDepartment'];
    $mobile = $_POST['inputMobile'];
    $email = $_POST['inputEmail'];
    $empId = $_POST['inputEmpId'];

    // Update the user in the database
    $query = "UPDATE user SET name='$name', department='$department', mobile='$mobile', email='$email', emp_id='$empId' WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // If update is successful, redirect back to the user list page
        header("Location: ../admin/update_user.php?id=$id");
        exit();
    } else {
        // If update fails, display an error message
        echo "Error updating user: " . mysqli_error($conn);
    }
} elseif (isset($_POST['submit_department'])) {
    // Retrieve department name from the form
    $department_name = $_POST['department_name'];
    $department_head = $_POST['department_head'];
    $group_id = $_POST['group_id'];
    // Prepare the SQL query to insert department into the database
    $query = "INSERT INTO department (department_name,group_id,head,createdOn) VALUES ('$department_name','$department_head','$group_id',NOW())";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Department inserted successfully, redirect to the previous page
        header("Location: ../admin/department.php");
        exit();
    } else {
        // If an error occurred while inserting department, display an error message
        echo "Error: " . mysqli_error($conn);
    }
} elseif (isset($_POST['update_department'])) {
    // Retrieve data from the form
    $id = $_POST['id']; // Get the user ID from the URL query parameter
    $name = $_POST['department_name'];
    $head = $_POST['department_head'];
    $group_id = $_POST['group_id'];


    // Update the user in the database
    $query = "UPDATE department SET department_name='$name', head='$head', group_id='$group_id' WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // If update is successful, redirect back to the user list page
        header("Location: ../admin/department.php?id=$id");
        exit();
    } else {
        // If update fails, display an error message
        echo "Error updating user: " . mysqli_error($conn);
    }
} elseif (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Generate a new password
    $new_password = generateRandomPassword("glansa");

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $update_query = "UPDATE user SET password='$hashed_password' WHERE name='$username'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Fetch user's email
        $email_query = "SELECT email FROM user WHERE name='$username'";
        $email_result = mysqli_query($conn, $email_query);
        $email_row = mysqli_fetch_assoc($email_result);
        $email = $email_row['email'];

        // Send email with the new password
        // $to = $email;
        $subject = "Password Reset";
        $email_body = "Hello $username,<br><br>Your password has been reset. Your new password is: $new_password<br><br>Thank you!";
        if (sendEmail($email, $subject, $email_body)) {
            echo "Password reset successfully. New password sent to the user's email.";
        } else {
            echo "Password reset successful, but failed to send email.";
        }
    } else {
        echo "Error resetting password.";
    }
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'suspend_user') {
        // Update the status in the database for suspension
        $updateQuery = "UPDATE user SET status = 0 WHERE id = $id";
        $updateResult = mysqli_query($conn, $updateQuery);
    } elseif ($action == 'activate_user') {
        // Update the status in the database for activation
        $updateQuery = "UPDATE user SET status = 1 WHERE id = $id";
        $updateResult = mysqli_query($conn, $updateQuery);
    } elseif ($action == 'delete_user') {
        // Delete the user from the database
        $deleteQuery = "DELETE FROM user WHERE id = $id";
        $deleteResult = mysqli_query($conn, $deleteQuery);
    }

    // Redirect back to the user list page
    header("Location: ../admin/user.php");
    exit();
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete_user' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user from the database
    $deleteQuery = "DELETE FROM user WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Redirect back to the user list page
    header("Location: ../admin/user.php");
    exit();
} elseif (isset($_GET['id'])) {
    // Sanitize the department ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare the delete query
    $query = "DELETE FROM department WHERE id = $id";

    // Execute the delete query
    if (mysqli_query($conn, $query)) {
        // If deletion is successful, redirect back to the department list page
        header("Location: ../admin/department.php");
        exit();
    } else {
        // If deletion fails, display an error message
        echo "Error deleting department: " . mysqli_error($conn);
    }
} elseif (isset($_POST['submit_modules'])) {
    // Collect form data
    $departmentId = $_POST['inputDepartment'];
    $moduleName = $_POST['modules_name'];
    $numSubModules = $_POST['dynamicmodules'];
    $subModules = array();
    for ($i = 0; $i < $numSubModules; $i++) {
        $subModules[] = array(
            'input' => $_POST['input_' . $i],
            'dropdown' => $_POST['dropdown_' . $i]
        );
    }

    // Check if module name already exists
    $checkModuleNameQuery = "SELECT COUNT(*) as count FROM modules WHERE name = '$moduleName'";
    $checkModuleNameResult = mysqli_query($conn, $checkModuleNameQuery);
    $row = mysqli_fetch_assoc($checkModuleNameResult);
    if ($row['count'] > 0) {
        // Module name already exists, show alert message
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Module name $moduleName already exists.";
        header("Location: ../admin/add_modules.php");
    } else {
        // Insert data into the modules table
        $insert_query = "INSERT INTO modules (dept_id, name, created_on, created_by) VALUES ('$departmentId', '$moduleName', NOW(), '{$_SESSION['name']}')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            // Fetch department name and department ID
            $fetchDepartmentNamequery = mysqli_query($conn, "SELECT d.department_name, m.dept_id FROM modules AS m JOIN department AS d ON d.id = m.dept_id WHERE m.id = LAST_INSERT_ID()");
            $fetchdepName = mysqli_fetch_assoc($fetchDepartmentNamequery);
            $departmentName = $fetchdepName['department_name'];
            $departmentId = $fetchdepName['dept_id'];

            // Construct table name
            $tableName = $moduleName . '_' . $departmentName;

            // Start building CREATE TABLE query
            $createTableQuery = "CREATE TABLE $tableName (
                id INT AUTO_INCREMENT PRIMARY KEY,
            ";

            // Iterate over sub modules to add columns
            for ($i = 0; $i < $numSubModules; $i++) {
                $columnName = $subModules[$i]['input'];
                $dataType = $subModules[$i]['dropdown'];
                // Add column to CREATE TABLE query
                $createTableQuery .= "$columnName $dataType, ";
            }

            // Add default columns
            $createTableQuery .= "
                created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                modified_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";

            // Execute the CREATE TABLE query
            $createTableResult = mysqli_query($conn, $createTableQuery);

            if ($createTableResult) {
                // Update submodule_name column in modules table
                $updateSubmoduleNameQuery = "UPDATE modules SET submodule_name = '$tableName' WHERE name = '$moduleName'";
                $updateSubmoduleNameResult = mysqli_query($conn, $updateSubmoduleNameQuery);

                if ($updateSubmoduleNameResult) {
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Table $tableName created successfully.";
                    header("Location: ../admin/add_modules.php");
                } else {
                    echo "Error updating submodule name: " . mysqli_error($conn);
                }
            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }
        } else {
            // Error occurred while inserting data
            $_SESSION['status'] = "danger";
            $_SESSION['message'] = "Failed to add module";
        }
    }
}

else {
    echo "Access denied.";
}
