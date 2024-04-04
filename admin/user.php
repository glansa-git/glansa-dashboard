<?php
include('includes/header.php');
include('includes/sidebar.php');

// Fetch data from the database
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);

// Fetch departments from the department table
$department_query = "SELECT * FROM department";
$department_result = mysqli_query($conn, $department_query);
?>


<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">User List</h4>
                        <a href="add_user.php" class="btn btn-dark text-white">ADD <i class="bi bi-plus-circle-fill"></i></a>
                    </div>
                    <!-- Filter Inputs -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="empIdInput" placeholder="Enter Employee ID">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="departmentDropdown">
                                <option value="">Select Department</option>
                                <?php
                                // Populate department dropdown options dynamically
                                while ($dept_row = mysqli_fetch_assoc($department_result)) {
                                    echo "<option value='" . $dept_row['department_name'] . "'>" . $dept_row['department_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="statusDropdown">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <!-- Table to display user data -->
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <!-- Table header -->
                    </table>
                    <!-- Div to display user data -->
                    <div id="userTableBody">
                        <!-- User data will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php include('includes/footer.php'); ?>

<!-- JavaScript to handle filtering -->
<script>
    // Function to handle filtering based on inputs
    function filterUsers() {
        var empId = document.getElementById('empIdInput').value;
        var department = document.getElementById('departmentDropdown').value;
        var status = document.getElementById('statusDropdown').value;

        // console.log(empId);
        // console.log(department);
        // console.log(status);
        // Send AJAX request to fetch filtered data
        var xhr = new XMLHttpRequest();

        // Check if any filter criteria are provided
        if (empId || department || status) {
            xhr.open('GET', '../config/filter.php?empId=' + empId + '&department=' + department + '&status=' + status, true);
        } else {
            // If no filter criteria are provided, fetch all users
            xhr.open('GET', '../config/filter.php', true);
        }

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = xhr.responseText;
                document.getElementById('userTableBody').innerHTML = response;
            }
        };
        xhr.send();
    }

    // Initial fetch of all users
    filterUsers();

    // Event listeners for input change
    document.getElementById('empIdInput').addEventListener('input', filterUsers);
    document.getElementById('departmentDropdown').addEventListener('change', filterUsers);
    document.getElementById('statusDropdown').addEventListener('change', filterUsers);
</script>
