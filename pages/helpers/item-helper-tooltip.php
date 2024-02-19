<?php
// Function to parse stats string into an associative array
function parseStatsString($statsString) {
    $statsArray = [];

    // Remove surrounding quotes if present
    $statsString = trim($statsString, '"');

    // Split the string into pairs
    $statsPairs = explode(', ', $statsString);

    foreach ($statsPairs as $statsPair) {
        list($stat, $value) = explode(' ', $statsPair, 2);
        $statsArray[trim($stat)] = trim($value);
    }

    return $statsArray;
}

// Function to check if item stats meet the conditions and return a reference item with additional stats
function checkItemConditions($item, $conditions, $uniqueItems, $setItems, $criteria = 'normal') {
    $type = strtolower(trim($item['item_name']));
    $quality = strtolower(trim($item['item_quality']));

    // Check if the item type has conditions defined
    if (isset($conditions[$type]['unique'][$criteria])) {
        $itemConditions = $conditions[$type]['unique'][$criteria];

        // Parse stats from the string
        $statsArray = [];
        preg_match_all('/(\w+) (\d+)/', $item['stats'], $matches);

        if (count($matches[1]) > 0) {
            $statsArray = array_combine($matches[1], $matches[2]);
        }

        // Check ethereal condition if defined
        if (isset($itemConditions['ethereal'])) {
            $etherealCondition = $itemConditions['ethereal'];
            $ethereal = intval($item['ethereal']);

            // Check ethereal condition
            if ($ethereal != $etherealCondition) {
                return null; // Ethereal condition not met
            }
        }

        // Check other stats conditions
        foreach ($itemConditions as $conditionKey => $conditionValue) {
            if ($conditionKey !== 'ethereal' && $conditionKey !== 'id') {
                if (!isset($statsArray[$conditionKey]) || $statsArray[$conditionKey] < $conditionValue) {
                    return null; // Stat condition not met
                }
            }
        }

        // Conditions met, return the id or name (or any other desired value)
        $referenceItem = $itemConditions['id'];

        // Lookup additional stats in the unique items JSON based on the reference item id
        if (isset($uniqueItems[$referenceItem])) {
            $additionalStats = $uniqueItems[$referenceItem];
            // You can handle or display the additional stats as needed
            return $additionalStats;
        }

        return $referenceItem;
    }
    else if (isset($conditions[$type]['set'][$criteria])) {
        $itemConditions = $conditions[$type]['set'][$criteria];

        // Parse stats from the string
        $statsArray = [];
        preg_match_all('/(\w+) (\d+)/', $item['stats'], $matches);

        if (count($matches[1]) > 0) {
            $statsArray = array_combine($matches[1], $matches[2]);
        }


        // Check ethereal condition if defined
        if (isset($itemConditions['ethereal'])) {
            $etherealCondition = $itemConditions['ethereal'];
            $ethereal = intval($item['ethereal']);

            // Check ethereal condition
            if ($ethereal != $etherealCondition) {
                return null; // Ethereal condition not met
            }
        }

        // Check other stats conditions
        foreach ($itemConditions as $conditionKey => $conditionValue) {
            if ($conditionKey !== 'ethereal' && $conditionKey !== 'id') {
                if (!isset($statsArray[$conditionKey]) || $statsArray[$conditionKey] < $conditionValue) {
                    return null; // Stat condition not met
                }
            }
        }

        // Conditions met, return the id or name (or any other desired value)
        $referenceItem = $itemConditions['id'];

        // Lookup additional stats in the unique items JSON based on the reference item id
        if (isset($setItems[$referenceItem])) {
            $additionalStats = $setItems[$referenceItem];
            // You can handle or display the additional stats as needed
            return $additionalStats;
        }

        return $referenceItem;
    }

    return null; // No conditions defined for the item type and quality
}

function getProperty($item, $propertyName) {
    // Check if the property exists in the unique item data
    if (isset($item[$propertyName])) {
        return $item[$propertyName];
    }

    return null;
}

// Function to get armor type based on the code
function getArmorType($code, $armorData) {
    foreach ($armorData as $armorType => $armorInfo) {
        if ($armorInfo['code'] === $code) {
            return $armorType;
        }
    }
    return null; // Return null if no matching armor type is found
}

// Function to display item tooltip with additional armor stats and basic stats
function displayItemTooltip($item, $itemConditions, $uniqueItems, $armorItems) {
    echo "<div class='tooltip'>Hover for details";

    // Check if item meets specific conditions and get the reference item with additional stats
    $normalReferenceItem = checkItemConditions($item, $itemConditions, $uniqueItems, 'normal');
    $perfectReferenceItem = checkItemConditions($item, $itemConditions, $uniqueItems, 'perfect');

    // Display the item name and stats
    echo "<div class='tooltip-content'>";

    // Display index and item name from uniqueitems.json
    displayIndexAndName($perfectReferenceItem, $normalReferenceItem);

    // Display name from armorItems.json
    $code = $normalReferenceItem !== null ? $normalReferenceItem['code'] : $perfectReferenceItem['code'];
    $armorType = getArmorType($code, $armorItems);

    if ($armorType !== null) {
        echo "{$armorItems[$armorType]['name']}<br>";
    }

    // Display specific stats
    displaySpecificStats($normalReferenceItem, $perfectReferenceItem);

    // Parse and display basic stats
    displayBasicStats($item['stats']);

    // Display additional stats from armor.json
    displayAdditionalStats($referenceItem, $armorItems);

    echo "</div>";
    echo "</div>";
}

// Function to display index and item name from uniqueitems.json with CSS classes for colors
function displayIndexAndName($perfectReferenceItem, $normalReferenceItem) {
    // Determine rarity class based on conditions
    $rarityClass = 'normal'; // Default class for normal items

    if ($perfectReferenceItem !== null) {
        $rarityClass = 'perfect';
    } elseif ($normalReferenceItem !== null) {
        $rarityClass = 'unique'; // Change to 'unique' class for unique items
    }

    // Output the item name with the corresponding CSS class
    $itemName = $perfectReferenceItem !== null ? "{$perfectReferenceItem['index']} (Perfect)" : ($normalReferenceItem !== null ? $normalReferenceItem['index'] : 'No matching conditions');

    // Apply CSS classes for colors
    $colorClasses = [
        'unique' => 'unique-color-class', // Add your unique color class here
        'perfect' => 'perfect-color-class', // Add your perfect color class here
        'normal' => 'normal-color-class', // Add your normal color class here
    ];

    $colorClass = $colorClasses[$rarityClass] ?? ''; // Default to an empty string if class not found

    echo "<span class='item-name $rarityClass $colorClass'>$itemName</span><br>";
}

// Function to display specific stats
function displaySpecificStats($normalReferenceItem, $perfectReferenceItem) {
    $referenceItem = $normalReferenceItem !== null ? $normalReferenceItem : $perfectReferenceItem;

    if ($referenceItem !== null) {
        $propertiesToDisplay = [
            'ac%' => 'Enhanced Defense',
            'res-all' => 'All Resistances',
            'cast3' => 'Faster Cast Rate',
            'red-mag' => 'Magic Damage Reduced By',
            'allskills' => 'To All Skills',
            'defense' => 'Defense',
        ];

        // Additional stats from armor.json
        $additionalStatsToDisplay = [
            'levelreq' => 'Required Level',
            'reqstr' => 'Required Strength',
            'durability' => 'Durability',
            // Add more stats as needed
        ];

        // Array to store stats with configuration information
        $stats = [];

        // Inside the loop for specific stats
        for ($i = 1; $i <= 5; $i++) {
            $propertyName = getProperty($referenceItem, "prop$i");
            $min = getProperty($referenceItem, "min$i");
            $max = getProperty($referenceItem, "max$i");

            // Retrieve configuration for the current stat
            $config = getConfigForStat($propertyName);

            // Use the format information for formatting the value
            $format = $config['format'] ?? '%d';
            $value = $min === $max ? $min : sprintf($format, $min, $max);

            // Store the stats in an array with configuration information
            $stats[] = [
                'name' => $propertyName,
                'display' => $propertiesToDisplay[$propertyName] ?? $propertyName,
                'value' => $value,
                'order' => $config['order'],
                'color' => $config['color'],
            ];
        }

        // Sort the stats based on color and order
        usort($stats, function ($a, $b) {
            if ($a['color'] === $b['color']) {
                return $a['order'] - $b['order'];
            }

            return $a['color'] === 'white' ? -1 : 1;
        });

        // Display the sorted stats
        foreach ($stats as $stat) {
            $displayName = $stat['display'];
            $value = $stat['value'];
            $color = $stat['color'];

            // Your display logic here using $color for styling
            echo "<span style='color: $color;'>$displayName: $value</span><br>";
        }
    }
}

// Function to display basic stats
function displayBasicStats($statsString) {
    $basicStatsArray = parseStatsString($statsString);

    // Additional configurations for basic stats
    $basicStatsConfigurations = [
        'Life' => ['order' => 5, 'color' => 'green'],
        'Mana' => ['order' => 6, 'color' => 'green'],
        // Add more basic stats and configurations as needed
    ];

    // Array to store basic stats with configuration information
    $stats = [];

    // Inside the loop for basic stats
    foreach ($basicStatsArray as $basicStatName => $basicStatValue) {
        // Retrieve configuration for the current basic stat
        $basicStatConfig = $basicStatsConfigurations[$basicStatName] ?? ['order' => PHP_INT_MAX, 'color' => ''];

        // Store the basic stats in the array with configuration information
        $stats[] = [
            'name' => $basicStatName,
            'display' => $basicStatName,
            'value' => $basicStatValue,
            'order' => $basicStatConfig['order'],
            'color' => $basicStatConfig['color'],
        ];
    }

    // Sort the stats based on color and order
    usort($stats, function ($a, $b) {
        if ($a['color'] === $b['color']) {
            return $a['order'] - $b['order'];
        }

        return $a['color'] === 'white' ? -1 : 1;
    });

    // Display the sorted basic stats
    foreach ($stats as $stat) {
        $displayName = $stat['display'];
        $value = $stat['value'];
        $color = $stat['color'];

        // Your display logic here using $color for styling
        echo "<span style='color: $color;'>$displayName: $value</span><br>";
    }
}

// Function to display additional stats from armor.json
function displayAdditionalStats($referenceItem, $armorItems) {
    $code = $referenceItem['code'];
    $armorType = getArmorType($code, $armorItems);

    if ($armorType !== null) {
        // Additional stats from armor.json
        $additionalStatsToDisplay = [
            'levelreq' => 'Required Level',
            'reqstr' => 'Required Strength',
            'durability' => 'Durability',
            // Add more stats as needed
        ];

        // For additional stats from armor.json
        foreach ($additionalStatsToDisplay as $statName => $displayName) {
            $statValue = $armorItems[$armorType][$statName];
            $config = getConfigForStat($displayName);

            // Use the format information for formatting the value
            $format = $config['format'] ?? '%d';
            $color = $config['color'] ?? 'blue';

            echo "<span style='color: $color;'>$displayName: " . sprintf($format, $statValue) . "</span><br>";
        }
    }
}

// Function to retrieve configuration for a given stat
function getConfigForStat($statName) {
    $configurations = [
        'Defense' => ['format' => '%d', 'order' => 1, 'color' => 'white'],
        'Required Level' => ['format' => '%d', 'order' => 1, 'color' => 'white'],
        'Required Strength' => ['format' => '%d', 'order' => 1, 'color' => 'white'],
        'Durability' => ['format' => '%d', 'order' => 1, 'color' => 'white'],
        'Enhanced Defense' => ['format' => '+%d%%', 'order' => 1, 'color' => 'white'],
        'To All Skills' => ['format' => '+%d', 'order' => 1, 'color' => 'white'],
        'Faster Cast Rate' => ['format' => '+%d%%', 'order' => 2, 'color' => 'blue'],
        'Magic Damage Reduced By' => ['format' => '%d-%d', 'order' => 3, 'color' => 'blue'],
        'All Resistances' => ['format' => '+%d-%d', 'order' => 4, 'color' => 'blue'],
        // Add more stats and configurations as needed
    ];

    return $configurations[$statName] ?? ['order' => PHP_INT_MAX, 'color' => ''];
}

// Function to display item tooltip with additional armor stats
function displaySimpleItem($item, $itemConditions, $uniqueItems, $armorItems, $setItems) {
    // Check if item meets specific conditions and get the reference item with additional stats
    $normalReferenceItemID = checkItemConditions($item, $itemConditions, $uniqueItems, $setItems, 'normal');
    $perfectReferenceItemID = checkItemConditions($item, $itemConditions, $uniqueItems, $setItems, 'perfect');

    // Get additional information from $setItems using the IDs
    $normalSetItem = isset($setItems[$normalReferenceItemID]) ? $setItems[$normalReferenceItemID] : null;
    $perfectSetItem = isset($setItems[$perfectReferenceItemID]) ? $setItems[$perfectReferenceItemID] : null;

    // Get the quality value from $item
    $quality = strtolower($item['item_quality']);

    echo "<span class='item-$quality'>";
    // Display index and item name from uniqueitems.json
    if ($perfectSetItem !== null) {
        echo "{$perfectSetItem['index']}";
        // Additional information from setItems for perfect quality
        // ...
    } elseif ($normalSetItem !== null) {
        echo "{$normalSetItem['index']}";
        // Additional information from setItems for normal quality
        // ...
    } else {
        // No matching conditions
        echo "{$item['item_name']}";
    }
    echo  "</span><br>";
}
?>