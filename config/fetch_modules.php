<?php
// Include database connection or any necessary PHP configurations
include "db_config.php";

if (isset($_POST['departmentId'])) {
    $departmentId = $_POST['departmentId'];

    // Fetch modules based on the selected department
    $query = "SELECT * FROM modules WHERE dept_id = '$departmentId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Build options for the module select element
        $options = "<option value=''>Select Modules</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
        }
        echo $options;
    } else {
        echo "<option value=''>No modules found</option>";
    }
}

else {
    echo "<option value=''>Invalid request</option>";
}

?>
