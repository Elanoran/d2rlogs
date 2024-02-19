<?php

function checkItemConditions($item, $conditions, $uniqueItems, $setItems) {
    $type = strtolower(trim($item['item_name']));
    $logInformation = "";

    //echo "Type: $type\n";

    // Check if the item type has conditions defined
    if (isset($conditions[$type])) {
        $itemConditions = $conditions[$type];

        //echo "All item conditions: " . json_encode($itemConditions) . "\n";

        // Parse stats from the string
        $statsArray = [];
        preg_match_all('/(\w+) (\d+)/', $item['stats'], $matches);

        if (count($matches[1]) > 0) {
            $statsArray = array_combine($matches[1], $matches[2]);
        }

        //echo "Ring stats: " . json_encode($statsArray) . "\n";
        $logInformation .= "Item Stats: " . generateHumanReadableStatsLog($statsArray) . "\n";

        // Check if both 'unique' and 'set' conditions are defined
        if (isset($itemConditions['unique'])) {
            //echo "Unique conditions: " . json_encode($itemConditions['unique']) . "\n";

            foreach ($itemConditions['unique'] as $uniqueSet) {
                // Check other stats conditions for 'unique'
                $conditionsMet = checkConditions($statsArray, $uniqueSet['conditions']);

                if ($conditionsMet) {
                    $referenceItem = isset($uniqueItems[$uniqueSet['id']]) ? $uniqueItems[$uniqueSet['id']] : null;
                    //echo "Unique item found: " . json_encode($referenceItem) . "\n";
                    $logInformation .= "Unique item found: " . generateHumanReadableItemLog2($referenceItem) . "\n";
                    return [$referenceItem, $logInformation];
                }
            }
        }

        if (isset($itemConditions['set'])) {
            foreach ($itemConditions['set'] as $setSet) {
                // Check other stats conditions for 'set'
                $conditionsMet = checkConditions($statsArray, $setSet['conditions']);

                if ($conditionsMet) {
                    $referenceItemId = (int)$setSet['id'];
                    foreach ($setItems as $setItem) {
                        if ((int)$setItem['*ID'] === $referenceItemId) {
                            //echo "Set item found: " . json_encode($setItem) . "\n";
                            $logInformation .= "Set item found: " . generateHumanReadableItemLog2($setItem) . "\n";
                            return [$setItem, $logInformation];
                        }
                    }
                    echo "No match found for set item!";
                    return [null, $logInformation]; // Set item not found
                }
            }
        }
    }

    //echo "No conditions met for the item!";
    return [null, $logInformation]; // No conditions defined for the item type and quality
}

/**
 * Generate a human-readable log for item stats conditions.
 *
 * @param array $conditions
 * @return string
 */
function generateHumanReadableStatsLog(array $conditions): string {
    $log = '';

    foreach ($conditions as $stat => $value) {
        $log .= "[$stat] >= $value";

        // Add logical AND for multiple conditions
        if (next($conditions) !== false) {
            $log .= ' && ';
        }
    }

    return $log;
}

/**
 * Generate a human-readable log for an individual item.
 *
 * @param array|null $item
 * @return string
 */
function generateHumanReadableItemLog2(?array $item): string {
    if ($item === null) {
        return 'Item not found';
    }

    $log = '';

    foreach ($item as $key => $value) {
        // You may customize this part based on your specific item array structure
        $log .= "[$key]: $value";

        // Add a comma and space for better readability
        $log .= ', ';
    }

    // Remove the trailing comma and space
    $log = rtrim($log, ', ');

    return $log;
}

function checkConditions($statsArray, $conditionSet) {
    // Check other stats conditions
    foreach ($conditionSet as $conditionKey => $conditionValue) {
        if ($conditionKey !== 'id') {
            // Check if the stat exists in the item stats
            if (!isset($statsArray[$conditionKey])) {
                return false; // Stat not found in item stats
            }

            // Extract the comparison operator and condition value
            preg_match('/([<>=]+)(\d+)/', $conditionValue, $matches);
            if ($matches) {
                $operator = $matches[1];
                $conditionValue = (int)$matches[2];

                // Check if the stat meets the condition
                $statValue = (int)$statsArray[$conditionKey];
                if (!evaluateCondition($statValue, $operator, $conditionValue)) {
                    return false; // Stat condition not met
                }
            }
        }
    }

    return true; // All conditions met
}



function evaluateCondition($leftOperand, $operator, $rightOperand) {
    switch ($operator) {
        case '>':
            return $leftOperand > $rightOperand;
        case '<':
            return $leftOperand < $rightOperand;
        case '>=':
            return $leftOperand >= $rightOperand;
        case '<=':
            return $leftOperand <= $rightOperand;
        case '=':
        case '==':  // Allow for both '=' and '==' for equality check
            return $leftOperand == $rightOperand;
        default:
            return false;
    }
}


// Function to display item tooltip with additional armor stats
function displaySimpleItem($item, $itemConditions, $uniqueItems, $setItems) {
    // Check if item meets specific conditions and get the reference item with additional stats
    $referenceItem = checkItemConditions($item, $itemConditions, $uniqueItems, $setItems, 'normal');

    // Get the quality value from $item
    $quality = strtolower($item['item_quality']);

    if (isset($item['timestamp']) && !empty($item['timestamp'])) {
        // Convert the timestamp to a DateTime object
        $timestamp = new DateTime($item['timestamp']);
        // Get the current date
        $currentDate = new DateTime('now');
        // Calculate the difference in days
        $interval = $currentDate->diff($timestamp);
        // Format the date based on the difference
        $formattedDate = formatRelativeDate($interval);
    } else {
        // Handle cases where the timestamp is not available
        $formattedDate = 'Unknown Date';
    }

    echo "<span class='item-$quality'>";
    // Output the item name with the corresponding CSS class
    if ($referenceItem !== null) {
        $itemName = $referenceItem['index'];
        echo "$itemName";
    } else {
        echo "{$item['item_name']}";
    }
    echo  "</span><span class='item-date'> - $formattedDate</span><br>";
}

function displaySimpleItemWithCheckbox($item, $itemConditions, $uniqueItems, $setItems, $characterName) {
    // Check if item meets specific conditions and get the reference item with additional stats
    list($referenceItem, $logInformation) = checkItemConditions($item, $itemConditions, $uniqueItems, $setItems);

    // Get the quality value from $item
    $quality = strtolower($item['item_quality']);

    if (isset($item['timestamp']) && !empty($item['timestamp'])) {
        // Convert the timestamp to a DateTime object
        $timestamp = new DateTime($item['timestamp']);
        // Get the current date
        $currentDate = new DateTime('now');
        // Calculate the difference in days
        $interval = $currentDate->diff($timestamp);
        // Format the date based on the difference
        $formattedDate = formatRelativeDate($interval);
    } else {
        // Handle cases where the timestamp is not available
        $formattedDate = 'Unknown Date';
    }

    echo "<li>";
    echo "<input type='checkbox' name='" . htmlspecialchars("{$characterName}_selectedItems[]") . "' value='" . htmlspecialchars($item['id']) . "' style='display:none;' data-id='" . htmlspecialchars($item['id']) . "' data-characterName='" . htmlspecialchars($characterName) . "' data-quality='" . htmlspecialchars($quality) . "' data-date='" . htmlspecialchars($formattedDate) . "' data-itemName='" . htmlspecialchars(($referenceItem !== null ? $referenceItem['index'] : $item['item_name'])) . "'>"; // Hidden checkbox with data attributes
    echo "<span class='item-$quality' onmouseover='showTooltip(this)' onmouseout='hideTooltip()'>";

    // Output the item name with the corresponding CSS class
    if ($referenceItem !== null) {
        $itemName = $referenceItem['index'];
        $type = $referenceItem['*ItemName'];
        echo "<span>";
        echo "$itemName";
        echo "</span>";
    } else {
        $type = "";
        echo "{$item['item_name']}";
    }
    // Add hover text with log information
    echo  "</span><span class='item-type'> $type</span><span class='item-date'>- $formattedDate</span><span class='item-hover' title='" . htmlspecialchars($logInformation) . "'> ℹ️ </span></li>";
    // Placeholder for tooltip
    echo "<div class='tooltip'></div>";
}


// Function to format relative date
function formatRelativeDate($interval) {
    if ($interval->y > 0) {
        return $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
    } elseif ($interval->m > 0) {
        return $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
    } elseif ($interval->d > 0) {
        return $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
    } elseif ($interval->h > 0) {
        return $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
    } elseif ($interval->i > 0) {
        return $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
    } else {
        return "just now";
    }
}

function moveItem($conn, $itemId, $newCharacterName) {
    // Validate and sanitize inputs
    $itemId = intval($itemId);
    $newCharacterName = $conn->real_escape_string($newCharacterName);

    // Check if the item exists
    $itemExists = checkIfItemExists($conn, $itemId);

    if ($itemExists) {
        // Update the bot_char_name of the item to the new character name
        $sql = "UPDATE items SET bot_char_name = '$newCharacterName' WHERE id = $itemId";
        $result = $conn->query($sql);

        if ($result) {
            // Item moved successfully
            return true;
        } else {
            // Error updating database
            return false;
        }
    } else {
        // Item not found
        return false;
    }
}

function deleteItem($conn, $itemId) {
    // Validate and sanitize inputs
    $itemId = intval($itemId);

    // Check if the item exists
    $itemExists = checkIfItemExists($conn, $itemId);

    if ($itemExists) {
        // Delete the item from the database
        $sql = "DELETE FROM items WHERE id = $itemId";
        $result = $conn->query($sql);

        if ($result) {
            // Item deleted successfully
            return true;
        } else {
            // Error deleting from the database
            return false;
        }
    } else {
        // Item not found
        return false;
    }
}

function checkIfItemExists($conn, $itemId) {
    // Validate and sanitize inputs
    $itemId = intval($itemId);

    // Check if the item exists in the database
    $sql = "SELECT id FROM items WHERE id = $itemId";
    $result = $conn->query($sql);

    return ($result->num_rows > 0);
}


?>