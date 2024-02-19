<?php

include '../config.php';
include 'helpers/itemconditions.php';
include 'helpers/item-helper.php';
include 'helpers/character_helper.php';

// Establish a database connection if needed
$conn = connectDB();
// Set the current page CSS variable (assuming it's the home page)
$pageCSS = 'character';

// Include Header Template
include_once '../templates/header-template.php';

// PHP Information Script
//echo "Server PHP Version: " . phpversion() . PHP_EOL;
//echo "PHP Extensions Loaded: " . implode(", ", get_loaded_extensions()) . PHP_EOL;
//echo "MySQLi Extension Enabled: " . (extension_loaded('mysqli') ? 'Yes' : 'No') . PHP_EOL;

$uniqueItems = json_decode(file_get_contents('../assets/json/uniqueitems.json'), true);
//$armorItems = json_decode(file_get_contents('json/armor.json'), true);
$setItems = json_decode(file_get_contents('../assets/json/setitems.json'), true);

?>

<div id="content">
    <?php
    // Display character list
echo "<h2>Character List</h2>";

$sql = "SELECT * FROM characters";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul class='character-list'>";
    while ($row = $result->fetch_assoc()) {
        $characterName = $row['character_name'];
        echo "<li class='character-item'>";
        echo "<div class='character-title' onclick='toggleDetails(this)'>";
        echo "<span class='toggle-icon'><i class='fas fa-chevron-down'></i></span>";
        echo "<span class='character-name'> $characterName</span>";
        echo "</div>";
        echo "<div class='character-details'>";
        echo "<h2>$characterName's Details</h2>";
        echo "<p><strong>Class:</strong> " . $row['class'] . "</p>";
        echo "<p><strong>Level:</strong> " . $row['level'] . "</p>";
        echo "<p><strong>Spec:</strong> " . $row['spec'] . "</p>";
        
        //echo "<form id='editForm' action='delete_items.php' method='post'>";
        echo "<form id='editForm' method='post'>";
        echo "<input type='hidden' id='editMode-$characterName' name='editMode' value='0'>";
        echo "<input type='submit' value='Edit' onclick='toggleEdit(\"$characterName\"); return false;'>";
        echo "<input type='submit' value='Move' id='moveBtn-$characterName' style='display:none;'>";
        echo "<input type='submit' value='Delete' id='deleteBtn-$characterName' style='display:none;'>";


         // Display items for the character
         $items = getCharacterItems($conn, $characterName);

         if ($items) {
             echo "<h3>Items:</h3>";
             echo "<ul>";
         
             // Display items in reverse order
            for ($i = count($items) - 1; $i >= 0; $i--) {
                displaySimpleItemWithCheckbox($items[$i], $itemConditions, $uniqueItems, $setItems, $characterName);
            }
         
             echo "</ul>";
         } else {
             echo "<p>No items</p>";
         }
 
         echo "</div>";
         echo "</li>";
     }
     echo "</ul></form>";
 } else {
     echo "<p>No characters found.</p>";
 }
 
     $conn->close();
     ?>
 </div>
</div> <!-- wrapper -->
 
<?php
    // Include Footer
    include_once '../templates/footer-template.php';
?>
 </body>
 </html>
