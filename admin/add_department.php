
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Department</h4>
                    <button onclick="goBack()" class="btn btn-secondary">Back</button>

                    <form action="../config/functions.php" method="POST">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Department Name:</label>
                            <input type="text" class="form-control" name="department_name" id="department_name" placeholder="Enter name" required>
                        </div>         
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Department Head:</label>
                            <input type="text" class="form-control" name="department_head" id="department_head" placeholder="Enter name" required>
                        </div>  
                        <!-- <div class="mb-3">
                            <label for="inputName" class="form-label">Group Id:</label>
                            <input type="text" class="form-control" name="group_id" id="group_id" placeholder="Enter name" required>
                        </div>                  -->
                        <button type="submit" class="btn btn-primary" value="Submit" name="submit_department">Submit</button>
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
</script>