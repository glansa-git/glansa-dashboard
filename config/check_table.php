<?php
// Include database connection or any necessary PHP configurations
include ('db_config.php');

if (isset($_POST['submodule'])) {
    $submodule = $_POST['submodule'];

    // Check if the submodule name exists in the modules table
    $checkModuleQuery = "SELECT submodule_name FROM modules WHERE submodule_name = '$submodule'";
    $checkModuleResult = mysqli_query($conn, $checkModuleQuery);

    if ($checkModuleResult && mysqli_num_rows($checkModuleResult) > 0) {
        // Submodule name exists in the modules table
        // Construct the table name based on the selected submodule name
        $tableName = strtolower($submodule); // Convert to lowercase

        // Check if the table exists in the database
        $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
        $checkTableResult = mysqli_query($conn, $checkTableQuery);

        if ($checkTableResult && mysqli_num_rows($checkTableResult) > 0) {
            // Table exists for the selected submodule
            echo 'exists';
        } else {
            // Table does not exist for the selected submodule
            echo 'not_exists';
        }
    } else {
        // Submodule name does not exist in the modules table
        echo 'not_found';
    }
} else {
    // If moduleName parameter is not set
    echo 'error';
}
?>
