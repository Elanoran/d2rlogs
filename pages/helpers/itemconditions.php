<?php
include_once __DIR__ . '/../../config.php';
$conn = connectDB();

function fetchItemConditionsFromDB($conn) {
    $itemConditions = [];

    // Fetch data from the database
    $query = "SELECT it.type_name AS item_type, ic.condition_type, ic.item_id,
                     sc.stat_name, sc.comparison_operator, sc.stat_value
              FROM ItemConditions ic
              JOIN ItemTypes it ON ic.item_type_id = it.id
              LEFT JOIN StatConditions sc ON ic.id = sc.item_condition_id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itemType = $row['item_type'];
            $conditionType = $row['condition_type'];
            $itemId = $row['item_id'];

            // Check if item_type is set in the array
            if (!isset($itemConditions[$itemType])) {
                $itemConditions[$itemType] = ['unique' => [], 'set' => []];
            }

            // Check if itemId is set in the array
            if (!isset($itemConditions[$itemType][$conditionType][$itemId])) {
                $itemConditions[$itemType][$conditionType][$itemId] = [
                    'id' => $itemId,
                    'conditions' => [],
                ];
            }

            $itemConditions[$itemType][$conditionType][$itemId]['conditions'][$row['stat_name']] =
                $row['comparison_operator'] . $row['stat_value'];
        }
    }

    return $itemConditions;
}




//echo "Debug code is running!";
// Fetch $itemConditions from the database
$itemConditions = fetchItemConditionsFromDB($conn);

// Output the structure directly in the HTML
//echo "<pre>";
//print_r($itemConditions);
//echo "</pre>";

$itemConditions2 = [
    'ring' => [
        'unique' => [
            // Unique ring conditions
            [
                'id' => '120',   // nagelring perfect
                'conditions' => ['magicfind' => '>=30', 'tohit' => '>=75'],
            ],
            [
                'id' => '120',   // nagelring
                'conditions' => ['magicfind' => '>=15'],
            ],
            [
                'id' => '121',   // manald heal perfect
                'conditions' => ['hpregen' => '>=8', 'manaleech' => '>=7'],
            ],
            [
                'id' => '122',   // stone of jordan
                'conditions' => ['maxmanapercent' => '>=25'],
            ],
            [
                'id' => '274',   // dwarf star perfect
                'conditions' => ['maxlife' => '>=40', 'magicdamagereduction' => '>=15'],
            ],
            [
                'id' => '275',   // raven frost perfect
                'conditions' => ['dexterity' => '>=20', 'tohit' => '>=250'],
            ],
            [
                'id' => '275',   // raven frost
                'conditions' => ['dexterity' => '>=20', 'tohit' => '>=150'],
            ],
            [
                'id' => '268',   // bul-kathos' wedding band perfect
                'conditions' => ['lifesteal' => '>=5', 'allskills' => '>=1'],
            ],
            [
                'id' => '268',   // bul-kathos' wedding band
                'conditions' => ['lifesteal' => '>=3', 'allskills' => '>=1'],
            ],
            [
                'id' => '300',   // nature's peace perfect
                'conditions' => ['poisonresist' => '>=30', 'normaldamagereduction' => '>=7'],
            ],
            [
                'id' => '319',   // wisp protector perfect
                'conditions' => ['absorblightpercent' => '>=20', 'magicbonus' => '>=20'],
            ],
            [
                'id' => '319',   // wisp protector
                'conditions' => ['absorblightpercent' => '>=20'],
            ],
            // Add other variations with their respective conditions
        ],
        'set' => [
            // Set ring conditions
            [
                'id' => '52',   // angelic halo
                'conditions' => ['maxlife' => '>=20'],
            ],
            [
                'id' => '29',   // cathan's seal
                'conditions' => ['lifeleech' => '>=6', 'normaldamagereduction' => '>=2'],
            ],
            // Set item conditions for rings
        ],


    ],

    'amulet' => [
        'unique' => [
            // Unique amulet conditions
            [
                'id' => '117',   // nokozan relic
                'conditions' => ['fireresist' => '>=50'],
            ],
            [
                'id' => '277',   // saracen's chance perfect
                'conditions' => ['strength' => '>=12', 'fireresist' => '>=25'],
            ],
            [
                'id' => '269',   // the cat's eye
                'conditions' => ['dexterity' => '>=25'],
            ],
            [
                'id' => '276',   // saracen's chance perfect
                'conditions' => ['lightresist' => '>=35'],
            ],
            [
                'id' => '272',   // mara's kaleidoscope perfect
                'conditions' => ['allskills' => '>=2', 'fireresist' => '>=30'],
            ],
            [
                'id' => '272',   // mara's kaleidoscope perfect
                'conditions' => ['allskills' => '>=2', 'fireresist' => '>=20'],
            ],
            [
                'id' => '302',   // seraph's hymn
                'conditions' => ['defensiveaurasskilltab' => '>=1'],
            ],
            [
                'id' => '302',   // seraph's hymn perfect
                'conditions' => ['defensiveaurasskilltab' => '>=2', 'itemdemondamagepercent' => '>=50', 'itemdemontohit' => '>=250', 'itemundeaddamagepercent' => '>=50', 'itemundeadtohit' => '>=250'],
            ],
            [
                'id' => '375',   // metalgrid perfect
                'conditions' => ['coldresist' => '>=35', 'plusdefense' => '>=350', 'tohit' => '>=450'],
            ],
            [
                'id' => '375',   // metalgrid
                'conditions' => ['coldresist' => '>=35', 'plusdefense' => '>=300'],
            ],
        ],
        'set' => [
            // Set amulet conditions
        ],
        // Add conditions for other qualities (normal, rare, etc.)
    ],
    // Add conditions for other item types



];

?>