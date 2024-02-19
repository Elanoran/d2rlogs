<?php
include_once __DIR__ . '/../../config.php';
$conn = connectDB();
$config = loadConfiguration($conn);
include 'item_quality.php';


// Get the total number of logs
$totalLogs = $conn->query("SELECT COUNT(*) as total FROM logs")->fetch_assoc()["total"];

// Get the timestamp of the latest log entry
$latestTimestamp = $conn->query("SELECT MAX(timestamp) as latest FROM logs")->fetch_assoc()["latest"];

// Echo the timestamp as the first line in the response
//echo $latestTimestamp . "\n";

// Number of logs per page
$logsPerPage = $config['logsPerPage'];

// Calculate total number of pages
$totalPages = ceil($totalLogs / $logsPerPage);

// Get the current page from the query string, default to 1
$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($currentpage - 1) * $logsPerPage;

// Query to fetch logs with pagination
$sql = "SELECT * FROM logs ORDER BY timestamp DESC LIMIT $offset, $logsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul class='cool-list'>";
    while ($row = $result->fetch_assoc()) {
        // Extract item name and stats
        $pos = strpos($row["message"], " Stats:");
        $displayMessage = ($pos !== false) ? substr($row["message"], 0, $pos) : $row["message"];
        $stats = ($pos !== false) ? substr($row["message"], $pos + 1) : '';

        // Output the modified message with an icon and custom CSS tooltip
        echo "<li class='cool-list-item'>
        <span class='item-name'>" . $row["timestamp"] . " &nbsp;&nbsp;&nbsp;&nbsp; " . $row["bot_name"] . "&nbsp;" . formatItemName($displayMessage) . "</span>
        <span class='stats-icon' data-stats='" . htmlentities($stats, ENT_QUOTES, 'UTF-8') . "'><i class='fa fa-info-circle' aria-hidden='true' style='color: #737373;'></i></span>
        </li>";
    }
    echo "</ul>";

    // Add pagination links
    echo "<br><div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='javascript:void(0);' onclick='loadLogs($i)'>$i</a> ";
    }
    echo "</div>";
} else {
    echo "No records found";
}

function extractDisplayMessage($message) {
    // Example: Extract the part before the first occurrence of " - Stats:"
    $pos = strpos($message, " Stats:");
    if ($pos !== false) {
        $displayMessage = substr($message, 0, $pos);
    } else {
        // If " - Stats:" is not found, display the entire message
        $displayMessage = $message;
    }

    return $displayMessage;
}

function formatItemName($message) {
    // Apply different colors for [Unique] and [Magic]
    $uniquePattern = "/\[Unique\]/";
    $magicPattern = "/\[Magic\]/";
    $rarePattern = "/\[Rare\]/";
    $setPattern = "/\[Set\]/";
    $normalPattern = "/\[Normal\]/";
    $lowqualityPattern = "/\[Lowquality\]/";

    if (preg_match($uniquePattern, $message)) {
        return preg_replace($uniquePattern, "<span class='item-unique'>[Unique]</span>", $message);
    } elseif (preg_match($magicPattern, $message)) {
        return preg_replace($magicPattern, "<span class='item-magic'>[Magic]</span>", $message);
    } elseif (preg_match($rarePattern, $message)) {
        return preg_replace($rarePattern, "<span class='item-rare'>[Rare]</span>", $message);
    } elseif (preg_match($setPattern, $message)) {
        return preg_replace($setPattern, "<span class='item-set'>[Set]</span>", $message);
    } elseif (preg_match($normalPattern, $message)) {
        return preg_replace($normalPattern, "<span class='item-normal'>[Normal]</span>", $message);
    } elseif (preg_match($lowqualityPattern, $message)) {
        return preg_replace($lowqualityPattern, "<span class='item-lowquality'>[Lowquality]</span>", $message);
    } else {
        return $message;
    }
}

//$conn->close();
?>