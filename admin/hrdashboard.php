<?php include ('includes/header.php'); ?>
<?php include ('includes/sidebar.php'); ?>

<style>
    .box {
        height: 200px;
        width: 200px;
        background-color: #D3D3D3;
        border-radius: 5%;
        margin: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
    }

    /* Add more custom styles as needed */
    .custom-select {
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
</head>

<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="department">Select Department:</label>
                <select class="form-select" name="inputDepartment" id="inputDepartment" required>
                    <option value="">Select Department</option>
                    <?php
                    // Fetch department names from the database
                    $query = "SELECT * FROM department";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['department_name'] . "</option>";
                    }
                    ?>
                    <!-- Options will be added dynamically using JavaScript -->
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="module">Select Module:</label>
                <select class="custom-select" id="module" name="module">
                    <option value="">Select Modules</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="module">Select SubModule:</label>
                <select class="custom-select" id="submodule" name="submodule">
                    <option value="">Select SubModule</option>
                </select>
            </div>
        </div>
    </div>
    <div id="dashboardContent" class="row mt-4">
        <!-- Display dashboard content here -->
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="uploadBtn">Choose File:</label><br>
                <input type="file" name="uploadFile" id="uploadBtn" accept=".csv"
                       class="form-control-file">
            </div>
        </div>
        <div class="col-md-6">
            <button type="button" id="submitBtn" name="submitBtn" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- jQuery UI for Datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        var selectedModuleName = ''; // Initialize selectedModuleName variable
        var tableExists = false; // Initialize tableExists variable
        var submodule = ''; // Initialize submodule variable

        $('#inputDepartment').change(function () {
            var departmentId = $(this).val();

            // Send AJAX request to fetch modules based on selected department
            $.ajax({
                url: '../config/fetch_modules.php', // Change the URL to the PHP script that fetches modules
                type: 'POST',
                data: {
                    departmentId: departmentId
                },
                success: function (response) {
                    // Update the module select element with the fetched modules
                    $('#module').html(response);

                    // Clear submodule dropdown when department changes
                    $('#submodule').html('<option value="">Select SubModule</option>');
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#module').change(function () {
            var moduleName = $(this).val();

            // Save selected module name for later use
            selectedModuleName = moduleName;

            // Send AJAX request to fetch sub-modules based on selected module
            $.ajax({
                url: '../config/fetch_submodules.php', // Change the URL to the PHP script that fetches sub-modules
                type: 'POST',
                data: {
                    moduleName: moduleName
                },
                success: function (response) {
                    // Update the sub-module select element with the fetched sub-modules
                    $('#submodule').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Event listener for the submodule dropdown change
        $('#submodule').change(function () {
            submodule = $(this).val();

            // Send AJAX request to check if the selected submodule name matches any table name
            $.ajax({
                url: '../config/check_table.php', // Change the URL to the PHP script that checks the table name
                type: 'POST',
                data: {
                    submodule: submodule
                },
                success: function (response) {
                    console.log(response);
                    if (response === 'exists') {
                        // If table exists, set tableExists to true
                        tableExists = true;
                        console.log('Table exists for submodule: ' + submodule);
                    } else {
                        // If table does not exist, set tableExists to false
                        tableExists = false;
                        console.log('Table does not exist for submodule: ' + submodule);
                        alert('Table does not exist for submodule: ' + submodule);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Event listener for the submit button click
        $('#submitBtn').click(function () {
            // Check if a file has been selected for upload
            if ($('#uploadBtn').val() === '') {
                alert('Please select a file to upload.');
                return;
            }

            // Check if submodule_name is same as tablename and table exists
            if ($('#submodule').val() === submodule && tableExists) {
                // Proceed with form submission
                uploadFile(submodule);
            } else {
                // Show alert indicating the submodule_name is not the same as tablename or table does not exist
                alert('Please select a valid module.');
            }
        });

        // Function to handle file upload
        function uploadFile(submodule) {
            var formData = new FormData();
            formData.append('file', $('#uploadBtn')[0].files[0]); // Append file to FormData
            formData.append('submodule', submodule); // Append submodule name to FormData

            // Send AJAX request to upload file to the selected table
            $.ajax({
                url: '../config/upload_file.php', // Change the URL to the PHP script that handles file upload
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    // Handle success response
                    console.log('File uploaded successfully.');
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(error);
                }
            });
        }
    });
</script>

