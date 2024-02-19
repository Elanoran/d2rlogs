// Function to show a message overlay with a countdown timer
function showMessageOverlay(message, duration) {
    var overlay = document.createElement('div');
    overlay.classList.add('message-overlay');
    var seconds = Math.floor(duration / 1000); // Calculate seconds

    console.log('Duration:', duration);

    overlay.textContent = message + ' Redirecting back to Characters in ' + seconds + ' seconds.';
    document.body.appendChild(overlay);

    // Countdown timer
    var timer = setInterval(function () {
        seconds--;
        overlay.textContent = message + ' Redirecting back to Characters in ' + seconds + ' seconds.';

        if (seconds <= 0) {
            clearInterval(timer);
            hideMessageOverlay();
            // Reload the page
            // Redirect to character-list.php
            window.location.href = '/pages/character-list.php';
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

function deleteCharacter(characterName, characterId) {
    if (confirm("Are you sure you want to delete this character?")) {
        // Use AJAX to send the delete request to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/pages/helpers/delete_character.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        // Parse the JSON response
                        const response = JSON.parse(xhr.responseText);

                        // Check if the character was deleted successfully
                        if (response.success) {
                            // Display a success message
                            showMessageOverlay('Character deleted successfully!', 4000);

                            // Hide the message overlay and reload the page after 4 seconds
                            setTimeout(function () {
                                hideMessageOverlay();

                                // Redirect to character-list.php
                                window.location.href = '/pages/character-list.php';
                            }, 4000);
                        } else {
                            // Display an error message
                            alert(response.message);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                    }
                } else {
                    // Display an error message for non-200 HTTP status
                    alert('Error: Unable to communicate with the server.');
                }
            }
        };

        // Convert the character data object to JSON and send it in the request body
        xhr.send(JSON.stringify({ characterName: characterName, characterId: characterId }));
    }
}

