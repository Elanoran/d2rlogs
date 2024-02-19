<?php
// item_conditions.php
include 'helpers/itemconditions.php';
// Set the current page CSS variable (assuming it's the home page)
$pageCSS = 'conditions';

// Include config file and functions
include_once '../config.php';

// Establish a database connection if needed
$conn = connectDB();
$itemConditions = fetchDetailedItemConditions($conn);

// Include Header Template
include_once '../templates/header-template.php';
?>



<div id="item-conditions-content">
    <h2>Item Conditions</h2>

    <?php
    // Get all unique item types
    $itemTypes = array_keys($itemConditions);
    ?>

    <!-- Display buttons for each item type -->
    <div class="item-type-buttons">
        <?php foreach ($itemTypes as $type) : ?>
            <button class="item-type-button" data-type="<?php echo $type; ?>"><?php echo ucfirst($type); ?></button>
        <?php endforeach; ?>
    </div>

    <?php foreach ($itemConditions as $itemType => $conditions) : ?>
        <h3 class="item-type"><?php echo ucfirst($itemType); ?></h3>

        <?php foreach ($conditions as $conditionType => $items) : ?>
            <h4 class="condition-type"><?php echo ucfirst($conditionType); ?></h4>

            <ul class="item-list">
                <?php foreach ($items as $item) : ?>
                    <li class="item">
                        <div class="item-header">
                            <span class="item-name <?php echo ($conditionType === 'set') ? 'item-set' : 'item-unique'; ?>">
                                <?php echo $item['item_name']; ?>
                            </span>
                            <span class="item-id-label">ID: </span>
                            <span class="item-id"><?php echo $item['id']; ?></span>
                            <span class="item-comment-label">Comment: </span>
                            <span class="item-comment"><?php echo $item['item_comment']; ?></span>
                            <span class="edit-button">Edit</span>
                        </div>
                        <div class="item-dropdown">
                            <form class="edit-form">
                                <label for="editName">Item Name:</label>
                                <input type="text" name="editName" value="<?php echo $item['item_name']; ?>">

                                <label for="editId">Item ID:</label>
                                <input type="text" name="editId" value="<?php echo $item['id']; ?>">

                                <label for="editComment">Item Comment:</label>
                                <input type="text" name="editComment" value="<?php echo $item['item_comment']; ?>">

                                <h4>Edit Conditions:</h4>
                                <!-- for editing conditions -->
                                <?php
                                foreach ($item['conditions'] as $statName => $condition) {
                                    // Use regular expression to extract operator and value
                                    preg_match('/^([<>]=?|==)\s*(\d+)$/', $condition, $matches);
                                
                                    // Check if the regular expression matched
                                    if (count($matches) === 3) {
                                        // Detailed condition with stat_name, comparison_operator, and stat_value
                                        echo '<div class="condition-row">';
                                        echo '<label for="editConditionStatName">Stat Name:</label>';
                                        echo '<input type="text" name="editConditionStatName[]" value="' . $statName . '">';
                                
                                        echo '<label for="editConditionOperator">Operator:</label>';
                                        echo '<input type="text" name="editConditionOperator[]" value="' . $matches[1] . '">';
                                    
                                        echo '<label for="editConditionValue">Value:</label>';
                                        echo '<input type="text" name="editConditionValue[]" value="' . $matches[2] . '">';
                                    
                                        echo '</div>';
                                    }
                                }
                                ?>

                                <!-- Add more input fields for editing conditions as needed -->


                                <span class="save-button" data-item-id="<?php echo $itemConditionId; ?>">Save</span>
                                <button type="button" class="cancel-button">Cancel</button>
                            </form>
                        </div>
                        <div class="conditions">
                            <?php
                            $formattedConditions = [];
                            foreach ($item['conditions'] as $statName => $condition) {
                                $formattedConditions[] = "[$statName] $condition";
                            }
                            echo implode(' && ', $formattedConditions);
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <!-- Modal Container -->
    <div id="modalContainerItem" class="your-modal-class">
        <!-- Your modal content goes here -->
    </div>
    <div id="item-conditions-content">     
        <button id="toggleAddItemForm" onclick="toggleAddItemForm()">Add Item Condition</button>
        
        <form id="addItemForm" style="display: none;">
            <label for="itemType">Item Type:</label>
            <input type="text" id="itemType" name="itemType" placeholder="Enter item type">

            <label for="itemName">Item Name:</label>
            <input type="text" id="itemName" name="itemName" placeholder="Enter item name">

            <label for="referenceId">Reference ID:</label>
            <input type="text" id="referenceId" name="referenceId" placeholder="Enter reference ID">

            <label for="conditionType">Condition Type:</label>
            <select id="conditionType" name="conditionType">
                <option value="unique">Unique</option>
                <option value="set">Set</option>
            </select>

            <label for="conditions">Conditions:</label>
            <textarea id="conditions" name="conditions" rows="4" placeholder="Example: [Stat] >= 10 && [AnotherStat] < 20"></textarea>
            <button type="button" onclick="addItem()">Add Item Condition</button>
        </form>
    </div>
</div>


<?php
// Include Footer
include_once '../templates/footer-template.php';

// Close the database connection if needed
if (isset($conn)) {
    $conn->close();
}



function fetchDetailedItemConditions($conn) {
    $detailedItemConditions = [];

    // Fetch data from the database
    $query = "SELECT ic.id AS item_condition_id, it.type_name AS item_type, ic.condition_type, ic.item_id,
                     ic.item_name, ic.item_comment,
                     sc.stat_name, sc.comparison_operator, sc.stat_value
              FROM ItemConditions ic
              JOIN ItemTypes it ON ic.item_type_id = it.id
              LEFT JOIN StatConditions sc ON ic.id = sc.item_condition_id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itemType = $row['item_type'];
            $conditionType = $row['condition_type'];
            $itemConditionId = $row['item_condition_id']; // Use this for editId
            $itemId = $row['item_id'];

            // Check if item_type is set in the array
            if (!isset($detailedItemConditions[$itemType])) {
                $detailedItemConditions[$itemType] = ['unique' => [], 'set' => []];
            }

            // Check if itemId is set in the array
            if (!isset($detailedItemConditions[$itemType][$conditionType][$itemId])) {
                $detailedItemConditions[$itemType][$conditionType][$itemId] = [
                    'id' => $itemConditionId,
                    'item_name' => $row['item_name'],
                    'item_comment' => $row['item_comment'],
                    'conditions' => [],
                ];
            }

            // Store the $itemConditionId in a variable to use in HTML
            $currentItemConditionId = $itemConditionId;

            $detailedItemConditions[$itemType][$conditionType][$itemId]['conditions'][$row['stat_name']] =
                $row['comparison_operator'] . $row['stat_value'];
        }
    }

    return $detailedItemConditions;
}

?>
