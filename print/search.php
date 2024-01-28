<div class="record-header">
    <div class="add">
        <button onclick="exportRecords()">Export Records</button>
    </div>

    <div class="browse">
        <input type="search" placeholder="Search" class="record-search" onkeyup="searchRecords()">
    </div>
</div>

<table id="record-table">
    <!-- Table headers and records go here -->
</table>

<script>
    // Function to export records
    function exportRecords() {
        // Implement the code to export records to PDF here
    }

    // Function to search records
    function searchRecords() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.querySelector(".record-search");
        filter = input.value.toUpperCase();
        table = document.getElementById("record-table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Change this index to match the column you want to search
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Populate the table with data from the database using server-side scripting
</script>
