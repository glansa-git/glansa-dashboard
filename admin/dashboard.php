<?php include ('includes/header.php');
include ('includes/sidebar.php'); ?>
<style>
    .box {
        height: 200px;
        width: 200px;
        background-color: #D3D3D3;
        border-radius: 5%;
        margin: 10px;
    }
</style>
<div class="container mt-5">
    <!-- <h1 class="text-center mb-4">Dashboard</h1> -->
    <div class="row">
        <div class="col-md-4">
            <!-- Date Range Filter -->
            <div class="form-group">
                <label for="dateRange">Select Date Range:</label>
                <input type="date" class="form-control" id="dateRange">
            </div>
        </div>
        <div class="col-md-4">
            <!-- Department Filter -->
            <div class="form-group">
                <label for="department">Select Department:</label>
                <select class="form-control" id="department">
                    <option value="">All Departments</option>
                    <?php
                    // Fetch departments from the database
                    $department_query = "SELECT * FROM department";
                    $department_result = mysqli_query($conn, $department_query);
                    if (mysqli_num_rows($department_result) > 0) {
                        while ($row = mysqli_fetch_assoc($department_result)) {
                            echo "<option value='" . $row['department_id'] . "'>" . $row['department_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Module Filter -->
            <div class="form-group">
                <label for="module">Select Module:</label>
                <select class="form-control" id="module">
                    <option value="">All Modules</option>
                    <!-- Populate module options dynamically using PHP -->
                    <option value="module1">Module 1</option>
                    <option value="module2">Module 2</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Display Filtered Data -->
    <div id="dashboardContent" class="mt-4">
        <!-- Display dashboard content here -->

    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="box"></div>
        </div>
        <div class="col-md-3">
            <div class="box"></div>
        </div>
        <div class="col-md-3">
            <div class="box"></div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>

<!-- Include necessary JavaScript libraries -->
<!-- Example: Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize datepicker
        $('#dateRange').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        // Function to load filtered data based on selected filters
        function loadFilteredData() {
            var dateRange = $('#dateRange').val();
            var department = $('#department').val();
            var module = $('#module').val();

            // Send AJAX request to fetch filtered data
            $.ajax({
                url: 'dashboard_data.php',
                type: 'GET',
                data: {
                    dateRange: dateRange,
                    department: department,
                    module: module
                },
                success: function (response) {
                    // Update dashboard content with filtered data
                    $('#dashboardContent').html(response);
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        }

        // Load filtered data initially
        loadFilteredData();

        // Event listeners for filter changes
        $('#dateRange, #department, #module').change(function () {
            loadFilteredData();
        });
    });
</script>