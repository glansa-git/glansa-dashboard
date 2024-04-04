<input type="number" class="form-control" id="dynamic-modules-input" name="dynamicmodules"/>

<div id="dynamic-modules-container">
  <!-- Rows will be added dynamically here -->
</div>
<script>
    document.getElementById('dynamic-modules-input').addEventListener('change', function() {
    var inputVal = parseInt(this.value);
    if (!isNaN(inputVal)) {
        createRows(inputVal);
    }
});

function createRows(numRows) {
    var container = document.getElementById('dynamic-modules-container');
    // Clear existing rows
    container.innerHTML = '';
    for (var i = 0; i < numRows; i++) {
        var row = document.createElement('div');
        row.classList.add('row');

        var inputColumn = document.createElement('div');
        inputColumn.classList.add('column');
        var inputField = document.createElement('input');
        inputField.setAttribute('type', 'text');
        inputField.setAttribute('placeholder', 'Input Field');
        inputColumn.appendChild(inputField);

        var dropdownColumn = document.createElement('div');
        dropdownColumn.classList.add('column');
        var dropdown = document.createElement('select');
        var options = ['A', 'B', 'C', 'D'];
        for (var j = 0; j < options.length; j++) {
            var option = document.createElement('option');
            option.value = options[j];
            option.text = options[j];
            dropdown.appendChild(option);
        }
        dropdownColumn.appendChild(dropdown);

        row.appendChild(inputColumn);
        row.appendChild(dropdownColumn);

        container.appendChild(row);
    }
}

</script>