<?php
// pages/index.php

// Set the current page CSS variable (assuming it's the home page)
$pageCSS = 'home';

// Include config file and functions
include_once 'config.php';

// Establish a database connection if needed
$conn = connectDB();
$config = loadConfiguration($conn);
$logsPerPage = $config['logsPerPage'];
// Include Header Template
include_once 'templates/header-template.php';
?>

<div id="config-content">
    <h2>Configuration</h2>

    <!-- Form for Clear Logs -->
    <form action="save_config.php" method="post">
        <h3>D2R Logs</h3>
        <label for="clearLogs">Clear Logs:</label>
        <select name="clearLogs" id="clearLogs" onchange="toggleDaysDropdown()">
            <option value="older-than">Clear Logs Older Than:</option>
            <option value="all">Clear All Logs</option>
        </select>
        <label for="days" id="daysLabel">Days:</label>
        <select name="days" id="days">
            <option value="1" selected>1 Day</option>
            <option value="7">7 Days</option>
            <option value="30">30 Days</option>
            <option value="90">90 Days</option>
            <!-- Add more options as needed -->
        </select>
        <button type="submit" name="action" value="clearLogs">Clear Logs</button>
    </form>
    </br>
    <!-- Form for Logs Per Page -->
    <form action="save_config.php" method="post">
        <label for="logsPerPage">Logs Per Page:</label>
        <input type="number" name="logsPerPage" id="logsPerPage" value="<?php echo $logsPerPage; ?>" />
        <button type="submit" name="action" value="saveLogsPerPage">Save Logs Per Page</button>
    </form>

    <!-- Other configurations as needed -->

    <script>
        function toggleDaysDropdown() {
            var clearLogsSelect = document.getElementById("clearLogs");
            var daysLabel = document.getElementById("daysLabel");
            var daysDropdown = document.getElementById("days");
            var logsPerPageInput = document.getElementById("logsPerPage");

            if (clearLogsSelect.value === "all") {
                daysLabel.style.display = "none";
                daysDropdown.style.display = "none";
                logsPerPageInput.style.display = "none";
            } else {
                daysLabel.style.display = "block";
                daysDropdown.style.display = "block";
                logsPerPageInput.style.display = "block";
            }
        }
    </script>
</div>

<?php
// Include Footer
include_once 'templates/footer-template.php';

// Close the database connection if needed
if (isset($conn)) {
    $conn->close();
}
?>
