<?php 
include('includes/header.php'); 
include('includes/sidebar.php');

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Fetch user data based on the provided ID
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Check if a user with the provided ID exists
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update User</h4>
                    <button onclick="goBack()" class="btn btn-secondary">Back</button>
                    <form action="../config/functions.php" method="POST">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Enter name" value="<?php echo $user['name']; ?>" required>
                            <input type="hidden" id="id" name="id" value="<?= $user['id'] ?>">
                        </div>
                        <!-- Other form fields with values fetched from the database -->
                        <!-- Modify other form fields accordingly -->
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Department:</label>
                            <select class="form-select" name="inputDepartment" id="inputDepartment" required>
                                <option value="">Select Department</option>
                                <?php
                                // Fetch department names from the database
                                $query = "SELECT department_name FROM department";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Check if the department matches the user's department
                                    $selected = ($row['department_name'] == $user['department']) ? 'selected' : '';
                                    echo "<option value='" . $row['department_name'] . "' $selected>" . $row['department_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Mobile No:</label>
                            <input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="Enter department" value="<?php echo $user['mobile']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter department" value="<?php echo $user['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">EMP Id:</label>
                            <input type="text" class="form-control" name="inputEmpId" id="inputEmpId" placeholder="Enter department" value="<?php echo $user['emp_id']; ?>">
                        </div>
                        <!-- Repeat similar blocks for other form fields -->
                        <button type="submit" class="btn btn-primary" name="update_user">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php 
    } else {
        // If no user found with the provided ID
        echo "User not found!";
    }
} else {
    // If the 'id' parameter is not set in the URL
    echo "User ID not provided!";
}


include('includes/footer.php'); 
?>
<script>
function goBack() {
  window.history.back();
}

</script>