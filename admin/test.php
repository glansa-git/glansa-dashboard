<?php
include('../config/db_config.php');

// Default columns
$id = "id";
$createdDate = date("Y-m-d H:i:s");
$modifiedDate = null; // Use null instead of "Null"
$tableName = "Anita";
$clmname1 = "name";
$clmname2 = "email";
$clmname3 = "phone";
$dt1 = "Varchar";
$dt1size = "225";
$dt2="int";
$dt2size="11";

if (isset($_POST['createtable'])) {
    // Perform table creation query here
    // For demonstration, let's assume you're creating a simple table
    $sql = "CREATE TABLE IF NOT EXISTS $tableName (
                $id INT AUTO_INCREMENT PRIMARY KEY,
                $clmname1 $dt1($dt1size),
                $clmname2 $dt1($dt1size),
                $clmname3 $dt1($dt1size),
                created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                modified_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Table created successfully.";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamically Generate Divs</title>
    <script>
        function generateInputFields(value) {
            // Get the container element where the divs will be appended
            var container = document.getElementById("container");

            // Clear previous content
            container.innerHTML = '';

            // Calculate the number of rows needed based on the value
            var numRows = Math.ceil(value / 4); // Assuming 4 columns per row

            // Generate divs in rows
            for (var i = 0; i < numRows; i++) {
                // Create a new row div
                var row = document.createElement("div");
                row.className = "row";

                // Append columns to the row
                for (var j = 0; j < 4; j++) { // Assuming 4 columns per row
                    var col = document.createElement("div");
                    col.className = "col-md-3"; // Assuming equal width columns
                    col.textContent = "Div " + (i * 4 + j + 1); // Unique content for each div
                    row.appendChild(col);
                }

                // Append the row to the container
                container.appendChild(row);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <input type="number" class=>
            </div>
        </div>
    </div>

    <!-- Container to hold dynamically generated divs -->
    <div id="container" class="container"></div>
</body>
</html>

