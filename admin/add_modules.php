<?php include ('includes/header.php'); ?>
<?php include ('includes/sidebar.php');

$sql = mysqli_query($conn, "select * from department");

?>

<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Modules</h4>
                    <?php if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
                        $status = $_SESSION['status'];
                        $message = $_SESSION['message'];
                        ?>
                        <div class="alert alert-<?= ($status == "success") ? 'success' : 'danger'; ?> w-50 alert-dismissible fade show"
                            role="alert">
                            <strong>
                                <?= $message; ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['message']);
                    } ?>
                    <button onclick="goBack()" class="btn btn-secondary">Back</button>

                    <form action="../config/functions.php" method="POST">
                        <div class="mb-3">
                            <label for="inputDepartment" class="form-label">Department:</label>
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
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Modules Name:</label>
                            <input type="text" class="form-control" name="modules_name" id="modules_name"
                                placeholder="Enter name" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <span class="text-right"><b>Create Sub Modules:</b></span>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control mb-4" name="dynamicmodules"
                                    id="dynamic-modules-input">
                            </div>
                        </div>

                        <div id="subModulesContainer"></div>

                        <button type="submit" class="btn btn-primary" value="Submit"
                            name="submit_modules">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php include ('includes/footer.php'); ?>
<script>
    document.getElementById('dynamic-modules-input').addEventListener('change', function () {
        var inputVal = parseInt(this.value);
        if (!isNaN(inputVal)) {
            createRows(inputVal);
        }
    });

    function createRows(numRows) {
        var container = document.getElementById('subModulesContainer');
        // Clear existing rows
        container.innerHTML = '';
        for (var i = 0; i < numRows; i++) {
            var row = document.createElement('div');
            row.classList.add('row', 'd-flex', 'mb-2');

            var inputColumn = document.createElement('div');
            inputColumn.classList.add('col-md-3');

            var inputField = document.createElement('input');
            inputField.classList.add('form-control');
            inputField.setAttribute('type', 'text');
            inputField.setAttribute('name', 'input_' + i); // Set name attribute dynamically
            inputField.setAttribute('placeholder', 'Input Field');
            inputColumn.appendChild(inputField);

            var dropdownColumn = document.createElement('div');
            dropdownColumn.classList.add('col-md-3');
            var dropdown = document.createElement('select');
            dropdown.classList.add('form-control');
            dropdown.setAttribute('name', 'dropdown_' + i); // Set name attribute dynamically
            populateDropdown(dropdown); // Populate dropdown with data from database
            dropdownColumn.appendChild(dropdown);

            row.appendChild(inputColumn);
            row.appendChild(dropdownColumn);

            container.appendChild(row);
        }
    }

    function populateDropdown(dropdown) {
        // Make an AJAX request to fetch data from the database
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../config/fetch_datatypes.php', true); // Assuming you have a PHP file to fetch data from the database
        xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                // Populate dropdown options with fetched data
                data.forEach(function (row) {
                    var option = document.createElement('option');
                    option.value = row.dtypeName + ' (' + row.dtypeSize + ')'; // Assuming datatypeName is the value you want to set
                    option.text = row.dtypeName;
                    dropdown.appendChild(option);
                });
                validateForm();
            }
        };
        xhr.send();
    }  
    // Function to enable/disable submit button based on form validation
// Function to validate the form
function validateForm() {
    var isValid = true;

    // Check if department and module name are filled
    var department = document.getElementById('inputDepartment');
    var moduleName = document.getElementById('modules_name');
    if (!department.value || !moduleName.value) {
        isValid = false;
    }

    // Check if dynamic modules field is filled
    var dynamicModulesInput = document.getElementById('dynamic-modules-input');
    if (!dynamicModulesInput.value) {
        isValid = false;
    }

    // Check if dynamic fields are filled
    var dynamicInputs = document.querySelectorAll('[name^="input_"]');
    var dynamicSelects = document.querySelectorAll('[name^="dropdown_"]');
    dynamicInputs.forEach(function(input) {
        if (!input.value) {
            isValid = false;
        }
    });
    dynamicSelects.forEach(function(select) {
        if (!select.value) {
            isValid = false;
        }
    });

    // Enable/disable submit button based on validation result
    document.querySelector('button[type="submit"]').disabled = !isValid;

    return isValid;
}

// Add form submission event listener
document.querySelector('form').addEventListener('submit', function(event) {
    if (!validateForm()) {
        // Prevent form submission if validation fails
        event.preventDefault();
    }
});

// Add event listener to dynamically created input fields
document.addEventListener('input', function(event) {
    if (event.target.tagName.toLowerCase() === 'input' || event.target.tagName.toLowerCase() === 'select') {
        validateForm();
    }
});

// Trigger form validation on page load
window.addEventListener('load', validateForm);

</script>
