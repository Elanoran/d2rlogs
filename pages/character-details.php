<?php
include '../config.php';
include 'helpers/character_helper.php';
include 'helpers/itemconditions.php';
include 'helpers/item-helper.php';

$conn = connectDB();
$pageCSS = 'character-details'; // Set the current page CSS variable

include_once '../templates/header-template.php';
?>

<!-- Message overlay container -->
<div id="message-overlay"></div>

<div id="content" class="centered-container">
    <div class="breadcrumbs">
        <a href="../pages/character-list.php">Character List</a> &gt; Character Details
    </div>
    <?php
    $characterName = isset($_GET['name']) ? urldecode($_GET['name']) : '';

    if ($characterName) {
        $character = getCharacterDetails($conn, $characterName);

        if ($character) {
            echo '<div class="two-column-container">';
            echo '<div class="character-details-container">';
            echo '<h2>' . ucwords($characterName) . "'s Details</h2>";
            echo '<p><strong>Class:</strong> ' . ucwords($character['class']) . '</p>';
            echo '<p><strong>Level:</strong> ' . $character['level'] . '</p>';
            echo '<p><strong>Spec:</strong> ' . $character['spec'] . '</p></br>';
            echo '<button class="delete-button" onclick="deleteCharacter(\'' . $character['character_name'] . '\', ' . $character['id'] . ')">Delete Character</button>';
            // Add image
            echo '<img src="' . getCharacterBackgroundImage(ucwords($character['class'])) . '" alt="Character Image" width="640" height="622" style="margin-top: 20px; opacity: 0.8;">';

            echo '</div>';

            $uniqueItems = json_decode(file_get_contents('../assets/json/uniqueitems.json'), true);
            $setItems = json_decode(file_get_contents('../assets/json/setitems.json'), true);

            // Display items for the character
            $items = getCharacterItems($conn, $characterName);

            if ($items) {
                echo '<div class="items-container">';
                echo '<input type="text" id="search-input-' . $characterName . '" placeholder="Search items..." style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: #171717; border: 1px solid #555; margin-bottom: 10px; width: 100%; box-sizing: border-box; color: #fff;">';
                echo '<div class="items-list-scroll">';
                echo '<h3>Items:</h3></br>';
                echo '<ul>';

                // Display items in reverse order
                for ($i = count($items) - 1; $i >= 0; $i--) {
                    displaySimpleItemWithCheckbox($items[$i], $itemConditions, $uniqueItems, $setItems, $characterName);
                }

                echo '</ul>';
                echo '</div></div>';
            } else {
                echo '<div class="items-container">';
                echo '<input type="text" id="search-input-' . $characterName . '" placeholder="Search items..." style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: #333; border: 1px solid #555; margin-bottom: 10px; width: 100%; box-sizing: border-box; color: #fff;">';
                echo '<div class="items-list-scroll">';
                echo '<h3>No items!</h3>';
                echo '<ul>';
            }

            echo '</div>'; // Close two-column-container
        } else {
            echo '<p>Character not found.</p>';
        }
    } else {
        echo '<p>Invalid character name.</p>';
    }

    $conn->close();
    ?>

</div>

<script>
    document.getElementById('search-input-<?php echo $characterName; ?>').addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();
        var items = document.querySelectorAll('.items-list-scroll ul li');

        items.forEach(function(item) {
            var itemName = item.textContent.toLowerCase();
            var displayStyle = itemName.includes(searchTerm) ? 'block' : 'none';
            item.style.display = displayStyle;
        });
    });
    function showTooltip(element) {
                var tooltipText = element.nextElementSibling.nextElementSibling.nextElementSibling.getAttribute('title');
                createTooltip();
                showTooltipElement(element.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling, tooltipText);
            }

            function hideTooltip() {
                hideTooltipElement(document.querySelector('.tooltip'));
            }

            function createTooltip() {
                if (!document.querySelector('.tooltip')) {
                    var tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    document.body.appendChild(tooltip);
                }
            }

            function showTooltipElement(element, text) {
                var position = getPosition(element);
                var tooltip = document.querySelector('.tooltip');
                tooltip.textContent = text;
                tooltip.style.top = position.top + element.offsetHeight + 'px';
                tooltip.style.left = position.left + 'px';
                tooltip.style.display = 'block';
            }

            function hideTooltipElement(element) {
                element.style.display = 'none';
            }

            function getPosition(el) {
                var rect = el.getBoundingClientRect();
                return {
                    top: rect.top + window.scrollY,
                    left: rect.left + window.scrollX
                };
            }
</script>

<?php
include_once '../templates/footer-template.php';
?>
</body>
</html>
