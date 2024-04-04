<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php');
if(isset($_GET['id'])) {
    // Fetch user data based on the provided ID
    $id = $_GET['id'];
    $query = "SELECT * FROM department WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Check if a user with the provided ID exists
    if(mysqli_num_rows($result) > 0) {
        $dept = mysqli_fetch_assoc($result);
        ?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Department</h4>
                    <button onclick="goBack()" class="btn btn-secondary">Back</button>

                    <form action="../config/functions.php" method="POST">
                        <input type="hidden" name="id" value="<?= $dept['id']?>"/>
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Department Name:</label>
                            <input type="text" class="form-control" name="department_name" value="<?= $dept['department_name'] ?>" id="department_name" placeholder="Enter name" required>
                        </div>         
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Department Head:</label>
                            <input type="text" class="form-control" name="department_head" value="<?= $dept['head'] ?>" id="department_head" placeholder="Enter name" required>
                        </div>  
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Group Id:</label>
                            <input type="text" class="form-control" name="group_id" id="group_id" value="<?= $dept['group_id'] ?>" placeholder="Enter name" required>
                        </div>                 
                        <button type="submit" class="btn btn-dark text-white" value="Submit" name="update_department">Submit</button>
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
include('includes/footer.php'); ?>
<script>
function goBack() {
  window.history.back();
}
</script>
