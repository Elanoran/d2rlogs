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
        // Retrieve character data from the request
        $characterData = json_decode(file_get_contents("php://input"), true);

        // Validate the received data (you might want to add more validation)
        if (
            isset($characterData['characterName']) &&
            isset($characterData['characterClass']) &&
            isset($characterData['characterSpec']) &&
            isset($characterData['characterLevel'])
        ) {
            // Extract data
            $characterName = $characterData['characterName'];
            $characterClass = $characterData['characterClass'];
            $characterSpec = $characterData['characterSpec'];
            $characterLevel = $characterData['characterLevel'];

            // Prepare and execute the insertion query
            $stmt = $conn->prepare("INSERT INTO characters (character_name, class, level, spec) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssis', $characterName, $characterClass, $characterLevel, $characterSpec);
            $stmt->execute();

            // Check for successful insertion
            if ($stmt->affected_rows > 0) {
                // Respond with a success message
                $response = ['success' => true, 'message' => 'Character added successfully.'];
                echo json_encode($response);
            } else {
                // Respond with an error message for failed insertion
                $response = ['success' => false, 'message' => 'Failed to add character.'];
                echo json_encode($response);
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
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
    error_log('Error in add_character.php: ' . $e->getMessage());

    // Respond with an error message
    $response = ['success' => false, 'message' => $e->getMessage()];
    echo json_encode($response);
}
?>
