<?php
// Include necessary files and start the session
include ('includes/header.php');
include ('includes/sidebar.php');

include "../config/db_config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ("../vendors/PHPMailer/PHPMailer.php");
require ("../vendors/PHPMailer/SMTP.php");
require ("../vendors/PHPMailer/Exception.php");

// Create a new instance of PHPMailer
$mail = new PHPMailer(true);

// Function to generate a random password
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

// Function to send email
function sendEmail($to, $subject, $body)
{
    global $mail; // Access the global $mail object

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

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Generate a new password
    $new_password = generateRandomPassword("glansa");

    // Update the user's password in the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_query = "UPDATE user SET password='$hashed_password' WHERE id=$user_id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Send email with the new password
        $user_query = "SELECT * FROM user WHERE id=$user_id";
        $user_result = mysqli_query($conn, $user_query);
        $user = mysqli_fetch_assoc($user_result);
        $to = $user['email'];
        $subject = "Password Reset";
        $body = "Hello " . $user['name'] . ",\n\nYour password has been reset. Your new password is: " . $new_password . "\n\nThank you!";
        if (sendEmail($to, $subject, $body)) {
            echo "Password reset successfully. New password sent to the user's email.";
        } else {
            echo "Error sending email.";
        }
    } else {
        echo "Error updating password.";
    }
} else {
    echo "User ID not provided!";
}

// Include footer
include ('includes/footer.php');
?>