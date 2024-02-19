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
        // Extract data
        $characterName = json_decode(file_get_contents("php://input"), true);
        $characterId = $characterName['characterId'];

        // Validate the received data
        if (isset($characterName['characterName'])) {
            // Extract data
            $characterToDelete = $characterName['characterName'];

            // Prepare and execute the deletion query
            $stmt = $conn->prepare("DELETE FROM characters WHERE character_name = ? AND id = ?");
            $stmt->bind_param('si', $characterToDelete, $characterId);
            $stmt->execute();

            // Check for successful deletion
            if ($stmt->affected_rows > 0) {
                // Respond with a success message
                $response = ['success' => true, 'message' => 'Character deleted successfully.'];
            } else {
                // Respond with an error message for failed deletion
                $response = ['success' => false, 'message' => 'Failed to delete character.'];
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        } else {
            // Respond with an error message for invalid data
            $response = ['success' => false, 'message' => 'Invalid data.'];
        }
    } else {
        // Respond with an error message for invalid requests
        $response = ['success' => false, 'message' => 'Invalid request.'];
    }

    // Output the JSON response
    echo json_encode($response);
} catch (Exception $e) {
    // Log the error message
    error_log('Error in delete_character.php: ' . $e->getMessage());

    // Respond with an error message
    $response = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($response);
}
?>
