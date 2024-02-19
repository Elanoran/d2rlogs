<?php

// bootstrap
define('BASE_PATH', '/');

// Set the environment (you can adjust this based on your server or configuration)
$environment = 'development'; // 'production' or 'development'

// Enable or disable error reporting based on the environment
if ($environment === 'production') {
    error_reporting(E_ALL & ~E_NOTICE); // Report all errors except notices
    ini_set('display_errors', 0); // Do not display errors to the screen
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1); // Display errors to the screen in development
}

function connectDB() {
    // Replace these values with your actual database credentials
    $servername = "192.168.1.2";
    $username = "d2rbot";
    $password = "VerySecretPass";
    $dbname = "d2r";

    // Create a new MySQLi object to establish a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set the character set to UTF-8 (optional, but recommended)
    $conn->set_charset('utf8');

    return $conn;
}

function loadConfiguration($conn) {
    try {
        // Fetch all configuration settings from the database
        $stmt = $conn->prepare("SELECT * FROM configuration LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();  // Get the result set
        $config = $result->fetch_assoc();  // Fetch data as an associative array

        if ($config) {
            // Return all configuration settings
            return $config;
        } else {
            // Return default values if no configuration found
            return array(
                'logsPerPage' => 7, // Set your default value for logsPerPage
            );
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function saveConfiguration($logsPerPage) {
    $conn = connectDB();

    try {
        $stmt = $conn->prepare("INSERT INTO configuration (id, logsPerPage) VALUES (1, ?) ON DUPLICATE KEY UPDATE logsPerPage = VALUES(logsPerPage)");
        $stmt->bind_param("i", $logsPerPage);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
// Load configuration settings
//$config = loadConfiguration(connectDB());
//$logsPerPage = $config['logsPerPage'];
?>
