<?php
header('Content-Type: application/json');
include 'db_config.php';

try {
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve selected items from the request
        $post_data = file_get_contents("php://input");
        $json_data = json_decode($post_data, true);

        if (isset($json_data['selectedItems']) && is_array($json_data['selectedItems'])) {
            $selectedItems = $json_data['selectedItems'];

            // Loop through selected items and perform the deletion
            foreach ($selectedItems as $itemId) {
                // Perform the deletion query using prepared statement
                $query = "DELETE FROM items WHERE id = ?";
                $statement = $conn->prepare($query);
                $statement->bind_param('i', $itemId);  // 'i' represents integer type
                $statement->execute();
        
                if ($statement->affected_rows <= 0) {
                    // Handle deletion failure
                    $response = ['success' => false, 'message' => 'Failed to delete items.'];
                    echo json_encode($response);
                    exit;
                }
            }
            // Respond with a success message
            $response = ['success' => true, 'message' => 'Items deleted successfully.'];
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
    error_log('Error in delete_items.php: ' . $e->getMessage());

    // Respond with an error message
    $response = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($response);
}
?>
