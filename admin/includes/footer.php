<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
            BootstrapDash.</span> -->
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All
            rights reserved. Saburi LMS</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- swall-scroller -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- plugins:js -->
<script src="./assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="./assets/vendors/chart.js/Chart.min.js"></script>
<script src="./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="./assets/vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="./assets/js/off-canvas.js"></script>
<script src="./assets/js/hoverable-collapse.js"></script>
<script src="./assets/js/template.js"></script>
<script src="./assets/js/settings.js"></script>
<script src="./assets/js/todolist.js"></script>
<script src="./assets/js/sweetalert.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

<!-- endinject -->
<!-- Custom js for this page-->
<script src="./assetsjs/jquery.cookie.js" type="text/javascript"></script>
<script src="./assetsjs/dashboard.js"></script>
<script src="./assetsjs/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

<!-- Rich Text Editor -->
<script type="text/javascript" src="assets/vendors/richtexteditor/rte.js"></script>
<script type="text/javascript" src='assets/vendors/richtexteditor/plugins/all_plugins.js'></script>

<!-- data table -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#example');
</script>
<!-- flora scripts -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>
<!-- <script type="text/javascript" src="./assets/vendors/summernote@0.8.18/js/summernote-lite.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    var emailInput = document.getElementById('emailInput');
    var errorText = document.getElementById('errorEmail');
    var insert_update = document.getElementById('insert_update');


    $(document).ready(function () {
        $(".mySummernote").summernote({
            height: 250
        });
        $('.dropdown-toggle').dropdown();
        emailInput.addEventListener('blur', function () {
            validateEmail();
        });

        function validateEmail() {
            var emailValue = emailInput.value.trim();
            var commonDomainPattern = /^(.+)@(gmail\.com|yahoo\.com|yahoo\.co.in|glansa\.com|glansa\.in|outlook\.com|iCloud\.com|live\.com|mail\.com|saburieducations\.com|saburieducations\.in)$/i;

            if (emailValue === '') {
                errorEmail.textContent = 'Email is required.';
            } else if (!commonDomainPattern.test(emailValue) || emailValue.includes(',')) {
                errorEmail.textContent = 'Enter a valid email address.';
                insert_update.disabled = true; // Disable the button
            } else {
                errorEmail.textContent = '';
                insert_update.disabled = false; // Enable the button
            }
        }
    });
    // accepting only numbers functions

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    function isText(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        // Allow letters and spaces
        if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode === 32) {
            return true;
        } else {
            return false;
        }
    }
    function validatePhoneNumber() {
        var phoneNumberInput = document.getElementById('phoneNumber');
        var errorText = document.getElementById('errorPhn');
        var phoneNumber = phoneNumberInput.value;

        // Allow only numeric input and check the maxlength
        if (/[^0-9]/.test(phoneNumber) || phoneNumber.length >= 15 || phoneNumber.length < 10 || (phoneNumber.length > 0 && !['6', '7', '8', '9'].includes(phoneNumber.charAt(0)))) {
            errorText.textContent = 'Enter a valid number';
            phoneNumberInput.setCustomValidity('Invalid phone number');
        } else {
            errorText.textContent = '';
            phoneNumberInput.setCustomValidity('');
        }
    }
    function resetForm() {
        document.getElementById("entry_form").reset();
        $('#editAddress').summernote('code', '');
    }
</script>


<script>
    function exportToExcel() {
        var table = document.getElementById("example");

        // Convert the table data to an array
        var data = [];
        var rows = table.getElementsByTagName("tr");
        var headerRow = [];
        // here taking the headers data and fetching the innertext--
        var headerCells = rows[0].getElementsByTagName("th");
        // console.log(headerCells);
        for (var k = 0; k < headerCells.length; k++) {
            headerRow.push(headerCells[k].innerText);
        }
        // pushing the headers
        data.push(headerRow);

        // Add data (td) to the data array
        for (var i = 1; i < rows.length; i++) {
            var row = [];
            var cells = rows[i].getElementsByTagName("td");
            for (var j = 0; j < cells.length; j++) {
                row.push(cells[j].innerText);
            }
            // pushing the rows data
            data.push(row);
        }

        // Creating a worksheet from the data push
        var ws = XLSX.utils.aoa_to_sheet(data);

        // Apply styles to the worksheet
        var range = XLSX.utils.decode_range(ws['!ref']);
        for (var R = range.s.r; R <= range.e.r; ++R) {
            for (var C = range.s.c; C <= range.e.c; ++C) {
                var cell_address = { c: C, r: R };
                var cell = ws[XLSX.utils.encode_cell(cell_address)];

                // Example: Apply border to all cells
                cell.s = { border: { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } } };
            }
        }

        // Create a workbook with the styled worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "CoursesListReport");

        // Save the workbook to a file
        XLSX.writeFile(wb, '<?= $filename;?>.xlsx');
    }
</script>

<script src="./assets/vendors/ckeditor/ckeditor.js"></script>
<script src="./assets/vendors/ckeditor/samples/js/sample.js"></script>

<!-- ck editor -->
<script>
    initSample();
</script>
<script type="text/javascript">

    CKEDITOR.replace('mc_learn');
    CKEDITOR.replace('mc_des');
    CKEDITOR.replace('mc_fetch_desc'); //
    CKEDITOR.replace('about_desc'); // for about page
    CKEDITOR.replace('content_desc'); //content page in manage chapter
    CKEDITOR.replace('home_ckeditor');// for home page
     CKEDITOR.replace('address_ckeditor'); //for contact page
    CKEDITOR.replace('privacy_ckeditor'); 
    CKEDITOR.replace('terms_ckeditor'); 
    CKEDITOR.replace('nl_desc'); 
    CKEDITOR.replace('blog_desc'); 
    CKEDITOR.replace('blog_fetch_desc'); 
    CKEDITOR.replace('mc_wyl'); 

    

</script>
<!-- ck editor end-->
</body>

</html>