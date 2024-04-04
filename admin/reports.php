<?php
include('includes/header.php');
include('includes/sidebar.php');

// Fetch data from the database
$result = null;

// Fetch data from the database if department information is found in the session
if (isset($_SESSION['department'])) {
    // If the department is set in the session, fetch only users from that department
    $userDepartment = $_SESSION['department'];
    $query = "SELECT * FROM user WHERE department = '$userDepartment'";
    $result = mysqli_query($conn, $query);
} else {
    // If the department is not set in the session, display an appropriate message
    $errorMessage = "Department information not found.";
}

$result = mysqli_query($conn, $query);

// Function to send email

?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">User List</h4>
                        <!-- Add a button for generating the report -->
                        <!-- <a href="generate_report.php" class="btn btn-dark text-white">Generate Report <i class="bi bi-file-earmark-spreadsheet-fill"></i></a> -->
                    </div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>EMP-ID</th>
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
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['department'] . "</td>";
                                    echo "<td>" . $row['mobile'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['emp_id'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                // If no rows returned from the query
                                echo "<tr><td colspan='5'>No users found</td></tr>";
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
