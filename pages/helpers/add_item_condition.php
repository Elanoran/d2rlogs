<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../../config.php';
$conn = connectDB();

try {
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve item condition data from the request
        $itemConditionData = json_decode(file_get_contents("php://input"), true);

        // Validate the received data (you might want to add more validation)
        if (
            isset($itemConditionData['itemType']) &&
            isset($itemConditionData['itemName']) &&
            isset($itemConditionData['referenceId']) &&
            isset($itemConditionData['conditionType'])
        ) {
            // Extract data
            $itemType = $itemConditionData['itemType'];
            $itemName = $itemConditionData['itemName'];
            $referenceId = $itemConditionData['referenceId']; // Use referenceId as item_id
            $conditionType = $itemConditionData['conditionType'];
            $conditions = isset($itemConditionData['conditions']) ? $itemConditionData['conditions'] : null;

            // Check if the item type exists, insert if not
            $itemTypeId = checkAndInsertItemType($itemType);

            // Insert item condition into the database
            insertItemCondition($itemTypeId, $itemName, "comment", $referenceId, $conditionType, $conditions);

            // Respond with a success message
            $response = ['success' => true, 'message' => 'Item added successfully.'];
            echo json_encode($response);
        } else {
            // Respond with an error message for invalid data
            $response = ['success' => false, 'message' => 'Invalid data.'];
            echo json_encode($response);
        }
    } else {
        // Respond with an error message for invalid requests
        $response = ['success' => false, 'message' => 'Invalid request.'];
        echo json_encode($response);
    }
} catch (Exception $e) {
    // Log the error message
    error_log('Error in add_item_condition.php: ' . $e->getMessage());

    // Respond with an error message
    $response = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($response);
}

function checkAndInsertItemType($itemType) {
    global $conn;

    // Check if the item type already exists in the database
    $stmt = $conn->prepare("SELECT id FROM ItemTypes WHERE type_name = ?");
    $stmt->bind_param('s', $itemType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Item type exists, fetch the ID
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        // Item type does not exist, insert it
        $stmt = $conn->prepare("INSERT INTO ItemTypes (type_name) VALUES (?)");
        $stmt->bind_param('s', $itemType);
        $stmt->execute();

        // Return the last inserted ID
        return $conn->insert_id;
    }
}

function insertItemCondition($itemTypeId, $itemName, $itemComment, $referenceId, $conditionType, $conditions) {
    global $conn;

    // Insert item condition into the database
    $stmt = $conn->prepare("INSERT INTO ItemConditions (item_type_id, item_name, item_comment, condition_type, item_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('issss', $itemTypeId, $itemName, $itemComment, $conditionType, $referenceId);
    $stmt->execute();

    // Check for successful insertion
    if ($stmt->affected_rows > 0) {
        // Get the last inserted ID
        $itemConditionId = $conn->insert_id;

        // Parse and insert conditions into StatConditions table
        parseAndInsertConditions($itemConditionId, $conditions);

        // Respond with a success message
        $response = ['success' => true, 'message' => 'Item condition added successfully.'];
        echo json_encode($response);
    } else {
        // Respond with an error message for failed insertion
        $response = ['success' => false, 'message' => 'Failed to add item condition.'];
        echo json_encode($response);
    }
}

function parseAndInsertConditions($itemConditionId, $conditions) {
    global $conn;

    // Parse conditions and insert into StatConditions table
    // You need to implement your logic here based on your conditions structure
    // For demonstration purposes, assuming conditions are provided in the format "[stat_name] [comparison_operator] [stat_value]"

    // Split conditions into an array
    $conditionArray = explode("&&", $conditions);

    // Loop through each condition and insert into StatConditions
    foreach ($conditionArray as $condition) {
        // Extract stat name, comparison operator, and stat value
        list($statName, $comparisonOperator, $statValue) = explode(" ", trim($condition));

        // Insert into StatConditions
        $stmt = $conn->prepare("INSERT INTO StatConditions (item_condition_id, stat_name, comparison_operator, stat_value) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $itemConditionId, $statName, $comparisonOperator, $statValue);
        $stmt->execute();
    }
}
?>
