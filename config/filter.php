<?php
// Include your database connection file
include "db_config.php";

// Retrieve filter parameters from the GET request
$empId = $_GET['empId'] ?? '';
$department = $_GET['department'] ?? '';
$status = $_GET['status'] ?? '';

// Construct the SQL query based on the filter parameters
$query = "SELECT * FROM user WHERE 1";

if (!empty($empId)) {
    $query .= " AND emp_id = '$empId'";
}

if (!empty($department)) {
    $query .= " AND department = '$department'";
}

if (!empty($status)) {
    $query .= " AND status = '$status'";
}

// Execute the SQL query
$result = mysqli_query($conn, $query);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    echo " <table id='example' class='table table-striped table-bordered' style='width:100%'>"; // Start the table
    echo "<tr>";
    echo "<th>S.no</th>";
    echo "<th>Name</th>";
    echo "<th>Department</th>";
    echo "<th>Mobile No</th>";
    echo "<th>Email</th>";
    echo "<th>EMP-ID</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    $serial = 1; // Initialize serial number
    // Output data in table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $serial++ . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td>" . $row['mobile'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['emp_id'] . "</td>";
        // Add actions column as needed
        echo "<td>";
        echo "<div class='dropdown'>";
        echo "<button class='btn btn-dark text-white dropdown-toggle' type='button' id='dropdownMenuButton$row[id]' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
        echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton$row[id]'>";
        echo "<li><a class='dropdown-item' href='update_user.php?id=" . $row['id'] . "'>Update</a></li>";
        if ($row['status'] == 1) {
            echo "<li><a class='dropdown-item' href='../config/functions.php?action=suspend_user&id=" . $row['id'] . "'>Suspend</a></li>";
        } else {
            echo "<li><a class='dropdown-item' href='../config/functions.php?action=activate_user&id=" . $row['id'] . "'>Activate</a></li>";
        }
        echo "<li><a class='dropdown-item' href='../config/functions.php?action=delete_user&id=" . $row['id'] . "'>Delete</a></li>";
        echo "<li><a class='dropdown-item' href='../config/functions.php?username=" . $row['name'] . "'>Reset Password</a></li>";
        echo "<li><a class='dropdown-item' href='../config/functions.php?username=" . $row['name'] . "'>View</a></li>";
        echo "</ul>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>"; // End the table
} else {
    // If no rows match the filter criteria
    echo "<p>No users found</p>";
}

// Close the database connection
mysqli_close($conn);
?>
