<?php
// Include database connection or any necessary PHP configurations
include ('db_config.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['file']) && isset($_POST['submodule'])) {
    $submodule = $_POST['submodule'];
    $file = $_FILES['file'];

    // Check if the uploaded file is a CSV file
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($fileExt !== 'csv') {
        echo 'Error: Only CSV files are allowed.';
        exit();
    }

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
            // Process file upload
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            // Get file extension
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allow certain file formats
            $allowedExtensions = array('csv', 'xlsx', 'xls');

            if (in_array($fileExt, $allowedExtensions)) {
                if ($fileError === 0) {
                    // Load the PhpSpreadsheet IOFactory
                    require '../vendor/autoload.php';

                    // Create a PhpSpreadsheet object from the uploaded file
                    $spreadsheet = IOFactory::load($fileTmpName);

                    // Get the first sheet
                    $sheet = $spreadsheet->getActiveSheet();

                    // Get the highest row number
                    $highestRow = $sheet->getHighestRow();

                    // Get column names from the first row
                    $colNames = $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];

                    // Prepare the SQL statement for insertion
                    $sql = "INSERT INTO $tableName (" . implode(', ', $colNames) . ") VALUES ";

                    // Iterate through each row and construct the SQL values part
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $sheet->getHighestColumn() . $row, NULL, TRUE, FALSE)[0];
                        $rowData = array_map(function ($value) use ($conn) {
                            return "'" . mysqli_real_escape_string($conn, $value) . "'";
                        }, $rowData);
                        $sql .= "(" . implode(', ', $rowData) . "), ";
                    }

                    // Remove the trailing comma and execute the SQL statement
                    $sql = rtrim($sql, ", ");
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>
                            swal("Success", "File data inserted successfully.", "success");
                        </script>';
                        // echo 'File data inserted successfully.';
                    } else {
                        echo 'Error inserting file data: ' . mysqli_error($conn);
                    }
                } else {
                    echo 'Error: ' . $fileError;
                }
            } else {
                echo 'Invalid file format. Allowed formats: ' . implode(', ', $allowedExtensions);
            }
        } else {
            // Table does not exist for the selected submodule
            echo 'Table does not exist for module: ' . $submodule;
        }
    } else {
        // Submodule name does not exist in the modules table
        echo 'Submodule name does not exist.';
    }
} else {
    // File or submodule parameter is not set
    echo 'Error: File or submodule parameter is missing.';
}
?>
