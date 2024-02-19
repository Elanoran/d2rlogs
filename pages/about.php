<?php
// pages/index.php

// Set the current page CSS variable (assuming it's the home page)
$pageCSS = 'about';

// Include config file and functions
include_once '../config.php';

// Establish a database connection if needed
$conn = connectDB();

// Include Header Template
include_once '../templates/header-template.php';
?>

<!-- Page Content -->
<div id="content">
    <div class="about-container">
        <h2>About D2R Logs</h2>
        <p>D2R Logs, your personal haven for chronicling the epic journeys and adventures of your Diablo® II: Resurrected characters! Immerse yourself in the nostalgic world of Sanctuary and meticulously record your characters' triumphs.</p>
        <p>D2R Logs is proudly built as an extension of the epic <a href="https://github.com/hectorgimenez/koolo" target="_blank">Koolo</a> project by Héctor Giménez. Koolo is a versatile bot framework that has laid the foundation for D2R Logs, providing a solid structure and functionality.</p>
        <p>Our gratitude goes to the Koolo project and its contributors for creating a platform that inspires and empowers developers to build innovative applications.</p>
        <p>With D2R Logs, we aim to extend the spirit of Koolo into the realm of Diablo® II: Resurrected, offering a specialized space for recording and celebrating your in-game adventures.</p>
    </div>
</div>

<?php
// Include Footer
include_once '../templates/footer-template.php';

// Close the database connection if needed
if (isset($conn)) {
    $conn->close();
}
?>
</body>
</html>
