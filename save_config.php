<?php
// save_config.php
error_reporting(E_ALL & ~E_NOTICE); // Report all errors except notices
ini_set('display_errors', 0); // Do not display errors to the screen
// Include config file and functions
include_once 'config.php';
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action === "clearLogs") {
        $clearLogsOption = $_POST["clearLogs"];

        if ($clearLogsOption === "older-than") {
            // Clear logs older than the specified duration
            deleteLogsOlderThan($conn);
        } elseif ($clearLogsOption === "all") {
            // Clear all logs
            clearAllLogs($conn);
        }

        // Use JavaScript for redirection
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } elseif ($action === "saveLogsPerPage") {
        // Handle save logs per page action
        $logsPerPage = $_POST["logsPerPage"];
        // Perform actions specific to saving logs per page
        saveConfiguration($logsPerPage);
    }

    // Use JavaScript for redirection
    echo '<script>window.location.href = "index.php";</script>';
    exit();
}

function clearAllLogs($conn) {
    try {
        // Prepare and execute the DELETE query to clear all logs
        $stmt = $conn->prepare("DELETE FROM logs");
        $stmt->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $stmt->close();
    }
}

function deleteLogsOlderThan($conn) {
    try {
        // Retrieve the selected number of days from the form
        $logsOlderThanDays = $_POST["days"];

        // Calculate the timestamp for logs older than the specified days
        $currentTimestamp = time();
        $olderThanTimestamp = date('Y-m-d H:i:s', strtotime("-$logsOlderThanDays days"));

        // Prepare and execute the DELETE query
        $stmt = $conn->prepare("DELETE FROM logs WHERE timestamp < ?");
        $stmt->bind_param("s", $olderThanTimestamp);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $stmt->close();
    }
}
?>
