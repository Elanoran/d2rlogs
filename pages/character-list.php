<?php
include '../config.php';
include 'helpers/character_helper.php';

$conn = connectDB();
$pageCSS = 'character-list'; // Set the current page CSS variable

include_once '../templates/header-template.php';
?>

<div id="content">

<!-- Message overlay container -->
<div id="message-overlay"></div>

    <?php
    $characters = getCharacterList($conn);

    if ($characters) {
    
    ?>
        <div class="list-container">
            <div class="menu-underline">
                <h2>Characters</h2>
                <button id="addCharacterButton" class="add-button" onclick="toggleAddCharacterModal()">Add Character</button>

            <!-- The modal container -->
            <div id="modalContainer" class="modal-container">
                <div class="modal-content form-pair">
                    <!-- Form to capture character information -->
                    <form id="addCharacterForm">
                        <div class="form-pair">
                            <label for="characterName">Name:</label>
                            <input type="text" id="characterName" name="characterName" required>
                        </div>
                        <div class="form-pair">
                            <label for="characterClass">Class:</label>
                            <select id="characterClass" name="characterClass" required onchange="updateSpecOptions()">
                                <?php
                                // Assuming $classList is an array of available classes
                                $classList = ['Amazon', 'Assassin', 'Barbarian', 'Druid', 'Necromancer', 'Paladin', 'Sorceress'];

                                foreach ($classList as $class) {
                                    echo '<option value="' . $class . '">' . $class . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-pair">
                            <label for="characterSpec">Spec:</label>
                            <select id="characterSpec" name="characterSpec" required>
                                <!-- Options will be dynamically populated based on the selected class -->
                            </select>
                        </div>
                        <div class="form-pair">
                        <label for="characterLevel">Level:</label>
                        <input size="200" type="number" id="characterLevel" name="characterLevel" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="1">
                        </div>

                        <!-- Button to submit the form -->
                        <button type="button" onclick="addCharacter()">Add Character</button>
                    </form>
                    <!-- Note about characters being made automatically -->
                    <p style="color: gray; font-style: italic; margin-top:5px;">Note: Characters are automatically created by Koolo, but you can use this form to add other characters.</p>
                </div>
            </div>
        </div>

        <?php
        echo '<ul class="character-list">';
        foreach ($characters as $character) {
            $backgroundImage = getBackgroundImage($character['class']);
            echo '<a href="character-details.php?name=' . urlencode($character['character_name']) . '">';
            echo '<li class="character-item">';
            echo '<div class="character-card" style="background-image: url(\'' . $backgroundImage . '\');">';
            echo '<span class="character-name">' . $character['character_name'] . " lvl " . $character['level'] . " - " .$character['spec'] . '</span>';
            echo '</div>';
            echo '</li>';
            echo '</a>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p>No characters found.</p>';
    }

    $conn->close();
    ?>

</div>

<?php
include_once '../templates/footer-template.php';
?>
</body>
</html>
