<?php
include_once __DIR__ . '/../../config.php';
$conn = connectDB();

// Retrieve form data
$itemName = $_POST['itemName'];
$itemType = $_POST['itemType'];
$conditionType = $_POST['conditionType'];
$itemComment = $_POST['itemComment'];

// Check if the item type already exists
$query = "SELECT id FROM ItemTypes WHERE type_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $itemType);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // If the item type already exists, retrieve its id
    $stmt->bind_result($itemTypeId);
    $stmt->fetch();
} else {
    // If the item type doesn't exist, insert it and retrieve the new id
    $query = "INSERT INTO ItemTypes (type_name) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $itemType);
    $stmt->execute();
    
    // Get the last inserted item_type_id
    $itemTypeId = $stmt->insert_id;
}

// Insert data into the ItemConditions table
$query = "INSERT INTO ItemConditions (item_type_id, condition_type, item_name, item_description)
          VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isss", $itemTypeId, $conditionType, $itemName, $itemComment);
$stmt->execute();

// Get the last inserted item_id
$itemId = $stmt->insert_id;

// Insert data into the StatConditions table
foreach ($_POST['conditionStatName'] as $index => $statName) {
    $operator = $_POST['conditionOperator'][$index];
    $value = $_POST['conditionValue'][$index];

    $query = "INSERT INTO StatConditions (item_condition_id, stat_name, comparison_operator, stat_value)
              VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issi", $itemId, $statName, $operator, $value);
    $stmt->execute();
}

// Check for errors
if ($stmt->errno) {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
} else {
    echo json_encode(['success' => true]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
