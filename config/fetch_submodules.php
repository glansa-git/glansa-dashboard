<?php
// Include database connection or any necessary PHP configurations
include('db_config.php');

if (isset($_POST['moduleName'])) {
    // Sanitize the input to prevent SQL injection
    $moduleName = mysqli_real_escape_string($conn, $_POST['moduleName']);

    // Fetch sub-modules based on the selected module using prepared statement
    $query = "SELECT submodule_name FROM modules WHERE name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $moduleName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Start building the HTML options for the sub-module dropdown
            $options = '<option value="">Select SubModule</option>';

            // Loop through the results and add each sub-module as an option
            while ($row = mysqli_fetch_assoc($result)) {
                $options .= '<option value="' . $row['submodule_name'] . '">' . $row['submodule_name'] . '</option>';
            }

            // Echo the options to be received by the AJAX success function
            echo $options;
        } else {
            // No sub-modules found for the selected module
            echo '<option value="">No SubModules Found</option>';
        }
    } else {
        // Error occurred while executing the query
        echo '<option value="">Error: Failed to fetch sub-modules</option>';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // moduleName parameter is not set
    echo '<option value="">Error: moduleName parameter is missing</option>';
}
?>
