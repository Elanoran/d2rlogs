// Function to open the add character modal
function openAddCharacterModal() {
    var modal = document.getElementById('addCharacterModal');
    modal.style.display = 'block';
}

// Function to close the add character modal
function closeAddCharacterModal() {
    var modal = document.getElementById('addCharacterModal');
    modal.style.display = 'none';
}

// Function to toggle the modal and update button text
function toggleAddCharacterModal() {
    var modalContainer = document.getElementById('modalContainer');
    var buttonTextElement = document.getElementById('addCharacterButton');

    modalContainer.classList.toggle('show');

    // Update button text based on modal state
    buttonTextElement.innerText = modalContainer.classList.contains('show') ? 'Cancel' : 'Add Character';
}


// Function to show a message overlay with a countdown timer
function showMessageOverlay(message, duration) {
    var overlay = document.createElement('div');
    overlay.classList.add('message-overlay');
    var seconds = Math.floor(duration / 1000); // Calculate seconds

    console.log('Duration:', duration);

    overlay.textContent = message + ' This page will refresh in ' + seconds + ' seconds.';
    document.body.appendChild(overlay);

    // Countdown timer
    var timer = setInterval(function () {
        seconds--;
        overlay.textContent = message + ' This page will refresh in ' + seconds + ' seconds.';

        if (seconds <= 0) {
            clearInterval(timer);
            hideMessageOverlay();
            // Reload the page
            window.location.reload();
        }
    }, 1000);
}

// Function to hide the message overlay
function hideMessageOverlay() {
    var overlay = document.querySelector('.message-overlay');
    if (overlay) {
        overlay.parentNode.removeChild(overlay);
    }
}

// Associative array mapping classes to specs
const specOptions = {
    Amazon: ['Leveling', 'Lightning Fury', 'Multiple Shot', 'Freezing Arrow', 'Poison Javelin', 'Strafe', 'Jab Fend', 'Lightning Strike', 'Exploding Arrow', 'Mule'],
    Assassin: ['Leveling', 'Lightning Sentry', 'Fire Blast', 'Dragon Tail', 'Whirlwind', 'Wake of Fire', 'Blade', 'Phoenix Strike', 'Rift', 'Dragon Tail', 'Claws of Thunder', 'Mule'],
    Barbarian: ['Leveling', 'Support', 'Gold Find', 'War Cry', 'Whirlwind', 'Berserk', 'Frenzy', 'Werewolf', 'Double Throw', 'Leap Attack', 'Mule'],
    Druid: ['Leveling', 'Tornado Hurricane', 'Shock Wave', 'Fury', 'Rabies', 'Fissure', 'Fire Claw', 'Summon', 'Maul', 'Mule'],
    Necromancer: ['Leveling', 'Summoner', 'Bone Spear', 'Poison Nova', 'Mercenary Corpse Explosion', 'Mule'],
    Paladin: ['Leveling', 'Blessed Hammer', 'Smite', 'Zeal', 'Dream', 'Fist of Heaven', 'Holy Fire', 'Mule'],
    Sorceress: ['Leveling', 'Lightning', 'Blizzard', 'Frozen Orb', 'Enchant', 'Fire Ball', 'Werebear', 'Hydra', 'Fire Wall', 'Nova', 'Zeal', 'Blaze', 'Mule'],
};

function updateSpecOptions() {
    const classSelect = document.getElementById('characterClass');
    const specSelect = document.getElementById('characterSpec');
    const selectedClass = classSelect.value;

    // Clear existing options
    specSelect.innerHTML = '';

    // Populate options based on the selected class
    if (specOptions[selectedClass]) {
        specOptions[selectedClass].forEach(spec => {
            const option = document.createElement('option');
            option.value = spec;
            option.text = spec;
            specSelect.add(option);
        });
    }
}

function addCharacter() {
    // Get character data from the form
    const characterName = document.getElementById('characterName').value;
    const characterClass = document.getElementById('characterClass').value;
    const characterSpec = document.getElementById('characterSpec').value;
    const characterLevel = document.getElementById('characterLevel').value;

    // Check if character name is empty
    if (characterName.trim() === '') {
        // Display an error message for empty character name
        alert('Please enter a character name.');
        return;
    }

    // Create an object with the character data
    const characterData = {
        characterName: characterName,
        characterClass: characterClass,
        characterSpec: characterSpec,
        characterLevel: characterLevel
    };

    // Use AJAX to send the data to the server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/pages/helpers/add_character.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Parse the JSON response
                const response = JSON.parse(xhr.responseText);

                // Check if the character was added successfully
                if (response.success) {
                    // Display a success message
                    showMessageOverlay('Character added successfully!', 4000);

                    // Hide the message overlay and reload the page after 4 seconds
                    setTimeout(function () {
                        hideMessageOverlay();

                        // Reload the page
                        window.location.reload();
                    }, 4000);
                } else {
                    // Display an error message
                    alert(response.message);
                }
            } else {
                // Display an error message for non-200 HTTP status
                alert('Error: Unable to communicate with the server.');
            }
        }
    };

    // Convert the character data object to JSON and send it in the request body
    xhr.send(JSON.stringify(characterData));

    // For now, just toggle the modal visibility
    toggleAddCharacterModal();
}


// Initial call to populate specs based on the default selected class
updateSpecOptions();
