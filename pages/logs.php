<?php
$pageCSS = 'logs';
include_once '../config.php';
$conn = connectDB();

// Establish a database connection if needed
//$conn = connectDB();
// Include Header Template
include_once '../templates/header-template.php';

// Set the current page CSS variable (assuming it's the home page)
$pageCSS = 'logs';
?>
<div id="botContainer">
    <?php include 'helpers/get_bots.php'; ?>
</div>

<div id="content">
    <div class="list-container">
        <h2>D2R Logs</h2>
        <div id="logsList">
            <?php include 'helpers/get_logs.php'; ?>
        </div>
        <!-- Display current page -->
        <br>
        <div id="currentPage">Current Page: <?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?></div>
        <div class="refresh-container">
            <input type="checkbox" id="autoRefreshCheckbox" checked>
            <label for="autoRefreshCheckbox">Enable Automatic Refresh</label>
        </div>
    </div>
</div>
<?php
    // Include Footer
    include_once '../templates/footer-template.php';
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Add event listener only when the DOM is fully loaded
    document.getElementById("autoRefreshCheckbox").addEventListener("change", toggleRefresh);
    
    // Update run timers using client-side clock
    //setInterval(updateBots, 3000);
    setInterval(updateRunTimers, 1000);
});
window.onload = function () {
    // Call your function after all content is loaded
    updateRunTimers();
};
document.addEventListener('DOMContentLoaded', function () {
    updateBots();
});
</script>
</body>
</html>
