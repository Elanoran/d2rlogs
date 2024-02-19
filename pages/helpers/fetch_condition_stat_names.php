<?php

include_once __DIR__ . '/../../config.php';
$conn = connectDB();

// Fetch distinct stat_name values
$query = "SELECT LOWER(stat_name) AS stat_name FROM stat_mapping";
$result = $conn->query($query);

// Check if there are results
if ($result->num_rows > 0) {
    $statNames = array();

    // Fetch data and store in array
    while ($row = $result->fetch_assoc()) {
        $statNames[] = $row['stat_name'];
    }

    // Convert array to JSON and echo the result
    echo json_encode($statNames);
} else {
    // No results found
    echo json_encode(array());
}

// Close connection
$conn->close();

?>
