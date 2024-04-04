<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add User</h4>
                    <button onclick="goBack()" class="btn btn-secondary">Back</button>

                    <form action="../config/functions.php" method="POST">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Enter name" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Department:</label>
                            <select class="form-select" name="inputDepartment" id="inputDepartment" required>
                                <option value="">Select Department</option>
                                <?php
                                // Fetch department names from the database
                                $query = "SELECT department_name FROM department";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['department_name'] . "'>" . $row['department_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Role:</label>
                            <select class="form-select" name="inputrole" id="inputrole" required>
                                <option value="">Select Role</option>
                                <?php
                                // Fetch department names from the database
                                $query = "SELECT role_name FROM role";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['role_name'] . "'>" . $row['role_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Mobile No:</label>
                            <input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="Enter department">
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter department">
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">EMP Id:</label>
                            <input type="text" class="form-control" name="inputEmpId" id="inputEmpId" placeholder="Enter department">
                        </div>
                        
                        <!-- <div class="mb-3">
                            <label for="inputStatus" class="form-label">Status:</label>
                            <select class="form-select" id="inputStatus">
                                <option selected>Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div> -->
                        <button type="submit" class="btn btn-dark" name="submit_user">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php include('includes/footer.php'); ?>
<script>
function goBack() {
  window.history.back();
}

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>