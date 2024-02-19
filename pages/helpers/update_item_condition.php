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
        // Retrieve item update data from the request
        $itemUpdateData = json_decode(file_get_contents("php://input"), true);

        // Log the received data to the error log for debugging
        error_log('Received data: ' . print_r($itemUpdateData, true));

        // Validate the received data (you might want to add more validation)
        if (
            isset($itemUpdateData['itemId'], $itemUpdateData['editName'], $itemUpdateData['editId'], $itemUpdateData['editComment'], $itemUpdateData['conditions'])
        ) {
            // Extract data
            $itemId = $itemUpdateData['itemId'];
            $editName = $itemUpdateData['editName'];
            $editId = $itemUpdateData['editId'];
            $editComment = $itemUpdateData['editComment'];
            $conditions = $itemUpdateData['conditions'];

            // Update item condition in the database
            updateItemCondition($itemId, $editName, $editId, $editComment, $conditions);
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
    error_log('Error in update_item_condition.php: ' . $e->getMessage());

    // Respond with an error message
    $response = ['success' => false, 'message' => 'An unexpected error occurred.'];
    echo json_encode($response);
}

// Update the itemConditionExists function
function itemConditionExists($itemId) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM ItemConditions WHERE id = ?");
    $stmt->bind_param('i', $itemId);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

// Update the updateItemCondition function
function updateItemCondition($itemId, $editName, $editId, $editComment, $conditions) {
    global $conn;

    // Check if the ItemConditions entry exists
    if (itemConditionExists($itemId)) {
        // Log entry existence
        error_log('ItemConditions entry found for id: ' . $itemId);

        // Update item condition in the database
        $stmt = $conn->prepare("UPDATE ItemConditions SET item_name = ?, item_comment = ? WHERE id = ?");
        $stmt->bind_param('ssi', $editName, $editComment, $itemId);

        // Log SQL query before execution
        $sqlQuery = "UPDATE ItemConditions SET item_name = ?, item_comment = ? WHERE id = ?";
        error_log('SQL Query: ' . $sqlQuery);

        // Check if the statement execution was successful
        if ($stmt->execute()) {
            $rowsUpdated = $stmt->affected_rows;

            // Delete existing conditions for the item
            $stmtDeleteConditions = $conn->prepare("DELETE FROM StatConditions WHERE item_condition_id = ?");
            $stmtDeleteConditions->bind_param('i', $itemId);
            $stmtDeleteConditions->execute();

            // Parse and insert updated conditions into StatConditions table
            parseAndInsertConditions($itemId, $conditions);

            // Respond with a success message
            $response = ['success' => true, 'message' => 'Item condition updated successfully.'];
            echo json_encode($response);
        } else {
            // Respond with an error message for failed update
            $response = ['success' => false, 'message' => 'Failed to update item condition.'];
            echo json_encode($response);

            // Log detailed error information
            $errorDetails = [
                'error_message' => $stmt->error,
                'stack_trace' => debug_backtrace()
            ];
            error_log('Error updating item condition: ' . json_encode($errorDetails));
        }
    } else {
        // Handle the case where the ItemConditions entry doesn't exist
        $response = ['success' => false, 'message' => 'ItemConditions entry not found for id: ' . $itemId];
        echo json_encode($response);
    }
}



function parseAndInsertConditions($itemConditionId, $conditions) {
    global $conn;

    // Parse conditions and insert into StatConditions table
    // You need to implement your logic here based on your conditions structure
    // For demonstration purposes, assuming conditions are provided in the format "[stat_name] [comparison_operator] [stat_value]"

    // Loop through each condition and insert into StatConditions
    foreach ($conditions as $condition) {
        // Extract stat name, comparison operator, and stat value
        list($statName, $comparisonOperator, $statValue) = explode(" ", trim($condition));

        // Insert into StatConditions
        $stmt = $conn->prepare("INSERT INTO StatConditions (item_condition_id, stat_name, comparison_operator, stat_value) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $itemConditionId, $statName, $comparisonOperator, $statValue);

        // Check if the statement execution was successful
        if (!$stmt->execute()) {
            // Log an error message if the execution fails
            $errorDetails = [
                'error_message' => $stmt->error,
                'sql_query' => $stmt->sql,
                'stack_trace' => debug_backtrace()
            ];
            error_log('Error inserting condition: ' . json_encode($errorDetails));
        }
    }
}
?>
