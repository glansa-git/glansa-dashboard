<?php
// Include your database connection file here
include('db_config.php');

// Fetch datatypes from the database
$query = "SELECT * FROM datatypes";
$result = mysqli_query($conn, $query);

// Check if datatypes are fetched successfully
if ($result) {
    $datatypes = array();
    // Fetch each datatype and store it in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $datatypes[] = $row;
    }
    // Send the datatypes data as JSON response
    header('Content-Type: application/json');
    echo json_encode($datatypes);
} else {
    // If an error occurred while fetching datatypes
    echo json_encode(array('error' => 'Failed to fetch datatypes'));
}
?>
