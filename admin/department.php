<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ("../vendors/PHPMailer/PHPMailer.php");
require ("../vendors/PHPMailer/SMTP.php");
require ("../vendors/PHPMailer/Exception.php");
$mail = new PHPMailer(true);

include('includes/header.php');
include('includes/sidebar.php');

// Fetch data from the database
$query = "SELECT * FROM department";
$result = mysqli_query($conn, $query);

// Function to send email
function sendEmailToUsers($conn, $departmentName) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
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
        // Fetch users from the database based on department name
        $query = "SELECT email FROM user WHERE department = '$departmentName'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $mail->addAddress($row['email']);  // Add recipient
        }

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Regarding Department Update';
        $mail->Body    = "Dear User,<br><br>This is to inform you about an update in your department.<br><br>Regards,<br>Your Organization";

        $mail->send();
        echo 'Email has been sent successfully';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Handle sending email action
if(isset($_GET['department'])) {
    $departmentName = $_GET['department'];
    sendEmailToUsers($conn, $departmentName);
}

?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Department List</h4>
                        <a href="add_department.php" class="btn btn-dark text-white">ADD <i class="bi bi-plus-circle-fill"></i></a>
                    </div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Department</th>
                                <th>Group ID</th>
                                <th>Head</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if there are any rows returned from the query
                            if (mysqli_num_rows($result) > 0) {
                                $serial = 1; // Initialize serial number
                                // Loop through each row in the result set
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Output data for each row
                                    echo "<tr>";
                                    echo "<td>" . $serial++ . "</td>";
                                    echo "<td>" . $row['department_name'] . "</td>";
                                    echo "<td>" . $row['group_id'] . "</td>";
                                    echo "<td>" . $row['head'] . "</td>";
                                    echo "<td>" . $row['createdOn'] . "</td>";
                                    // Add actions column as needed
                                    echo "<td>";
                                    echo "<div class='dropdown'>";
                                    echo "<button class='btn btn-dark text-white dropdown-toggle' type='button' id='dropdownMenuButton$row[id]' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                    echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton$row[id]'>";
                                    echo "<li><a class='dropdown-item' href='update_head.php?id=" . $row['id'] . "'>Update Head</a></li>";
                                    echo "<li><a class='dropdown-item' href='../config/functions.php?id=" . $row['id'] . "'>Change Group ID</a></li>";
                                    echo "<li><a class='dropdown-item' href='../config/functions.php?id=" . $row['id'] . "'>View</a></li>";
                                    echo "<li><a class='dropdown-item' href='../config/functions.php?id=" . $row['id'] . "'>Delete</a></li>";
                                    echo "<li><a class='dropdown-item' href='?department=" . $row['department_name'] . "'>Send Email</a></li>";

                                    // Add more dropdown menu items as needed
                                    echo "</ul>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                // If no rows returned from the query
                                echo "<tr><td colspan='6'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php include('includes/footer.php'); ?>
