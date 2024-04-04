<?php
include ('includes/header.php');
include ('includes/sidebar.php');

// Fetch data from the database
$query = "SELECT modules.*, department.department_name FROM modules INNER JOIN department ON modules.dept_id = department.id";
$result = mysqli_query($conn, $query);

?>


<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Module List</h4>
                        <a href="add_modules.php" class="btn btn-dark text-white">ADD <i
                                class="bi bi-plus-circle-fill"></i></a>
                    </div>

                    <!-- Table to display module data -->
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Name</th>
                                <th>Department</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $serial = 1;
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <!-- Table rows for module data -->
                                <tr>
                                    <td>
                                        <?php echo $serial++; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['department_name']; ?>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                    <!-- Div to display module data -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php include ('includes/footer.php'); ?>

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

        xhr.onload = function () {
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
