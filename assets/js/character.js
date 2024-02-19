document.addEventListener("DOMContentLoaded", function () {
    var characterItems = document.querySelectorAll('.character-item');

    characterItems.forEach(function (item) {
        item.addEventListener('click', function (event) {
            var characterDetails = this.querySelector('.character-details');

            if (characterDetails.style.display === 'block') {
                characterDetails.style.display = 'none';
                this.querySelector('.toggle-icon i').classList.remove('fa-chevron-up');
                this.querySelector('.toggle-icon i').classList.add('fa-chevron-down');
            } else {
                characterItems.forEach(function (otherItem) {
                    var otherDetails = otherItem.querySelector('.character-details');
                    if (otherDetails !== characterDetails) {
                        otherDetails.style.display = 'none';
                        otherItem.querySelector('.toggle-icon i').classList.remove('fa-chevron-up');
                        otherItem.querySelector('.toggle-icon i').classList.add('fa-chevron-down');
                    }
                });

                characterDetails.style.display = 'block';
                this.querySelector('.toggle-icon i').classList.remove('fa-chevron-down');
                this.querySelector('.toggle-icon i').classList.add('fa-chevron-up');
            }

            // Prevent the click event from propagating to the "Edit" button
            event.stopPropagation();
        });

        var editButton = item.querySelector('.edit-button');
        editButton.addEventListener('click', function (event) {
            // Stop the click event propagation
            event.stopPropagation();

            // Extract characterName from the dataset attribute
            var characterName = this.dataset.characterName;

            toggleEdit(characterName);
        });

        var editForm = item.querySelector('.editForm');
        editForm.addEventListener('submit', function (event) {
            event.preventDefault();
        });
    });
});

function toggleDetails(element) {
    var characterDetails = element.nextElementSibling;

    if (characterDetails) {
        if (characterDetails.style.display === 'block') {
            characterDetails.style.display = 'none';
            var toggleIcon = element.querySelector('.toggle-icon i');
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
            }
        } else {
            // Hide other open character details
            var characterItems = document.querySelectorAll('.character-item');
            characterItems.forEach(function (otherItem) {
                var otherDetails = otherItem.querySelector('.character-details');
                if (otherDetails && otherDetails !== characterDetails) {
                    otherDetails.style.display = 'none';
                    var toggleIcon = otherItem.querySelector('.toggle-icon i');
                    if (toggleIcon) {
                        toggleIcon.classList.remove('fa-chevron-up');
                        toggleIcon.classList.add('fa-chevron-down');
                    }
                }
            });

            characterDetails.style.display = 'block';
            var toggleIcon = element.querySelector('.toggle-icon i');
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            }
        }

        // Store the state in local storage
        var characterNameElement = characterDetails.querySelector('.character-name');
        if (characterNameElement) {
            var characterName = characterNameElement.textContent.trim();
            var isOpen = characterDetails.style.display === 'block';
            localStorage.setItem('characterDetailsState_' + characterName, isOpen);
        }
    }
}

function toggleEdit(characterName) {
    var editModeInput = document.getElementById('editMode-' + characterName);
    var moveBtn = document.getElementById('moveBtn-' + characterName);
    var deleteBtn = document.getElementById('deleteBtn-' + characterName);
    var checkboxes = document.querySelectorAll("input[name='" + characterName + "_selectedItems[]']");

    // Declare selectedItems outside the if block
    var selectedItems = [];

    // Function to update selected items in localStorage
    function updateLocalStorage() {
        localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
    }

    // Load selected items from localStorage if available
    var storedSelectedItems = localStorage.getItem('selectedItems');
    if (storedSelectedItems) {
        selectedItems = JSON.parse(storedSelectedItems);

        // Check the corresponding checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = selectedItems.includes(checkbox.value);
        });
    }

    if (editModeInput.value == 0) {
        // Entering edit mode
        editModeInput.value = 1;
        moveBtn.style.display = 'inline';
        deleteBtn.style.display = 'inline';

        // Show checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.style.display = 'inline';
        });

        // Attach click event to the delete button
        deleteBtn.addEventListener('click', function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Collect selected item names
            selectedItems = [];
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    selectedItems.push(checkbox.value);  // Use checkbox value (item ID) instead of textContent
                }
            });

            // Update localStorage
            updateLocalStorage();

            // Check if at least one item is selected
            if (selectedItems.length === 0) {
                alert('Please select at least one item to delete.');
                return;
            }

            fetch('/pages/helpers/delete_items.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ selectedItems: selectedItems }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle the server response
                    if (data.success) {
                        // Display the overlay based on the response
                        var message;
                        if (selectedItems.length === 1) {
                            message = 'Item deleted successfully: ' + selectedItems[0];
                        } else {
                            message = 'Items deleted successfully: ' + selectedItems.join(', ');
                        }

                        showMessageOverlay(message);

                        setTimeout(function () {
                            hideMessageOverlay();

                            // Reload the page
                            window.location.reload();
                        }, 4000);
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Log the full response for inspection
                    response.text().then(text => {
                        console.log('Full response:', text);
                    });

                    alert('Network error occurred. Check the console for details.');
                });
        });
    } else {
        // Exiting edit mode
        editModeInput.value = 0;
        moveBtn.style.display = 'none';
        deleteBtn.style.display = 'none';

        // Hide checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.style.display = 'none';
        });
    }
}



// Function to show a message overlay
function showMessageOverlay(message) {
    var overlay = document.createElement('div');
    overlay.classList.add('message-overlay');
    overlay.textContent = message;
    document.body.appendChild(overlay);
}

// Function to hide the message overlay
function hideMessageOverlay() {
    var overlay = document.querySelector('.message-overlay');
    if (overlay) {
        overlay.parentNode.removeChild(overlay);
    }
}

function displayItemWithCheckbox(item, characterName) {
    var itemName = item['item_name'];
    var itemId = item['id'];

    var listItem = document.createElement('li');
    var checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.name = 'selectedItems[]-' + characterName;
    checkbox.value = itemId;
    checkbox.style.display = 'none';

    var itemQuality = document.createElement('span');
    itemQuality.classList.add('item-quality');
    itemQuality.textContent = itemName;

    // Append checkbox and item quality to the list item
    listItem.appendChild(checkbox);
    listItem.appendChild(itemQuality);

    // Assuming there is an existing container to append this list item to
    // For example, you can append it to the existing 'ul' element inside the character details
    var itemList = document.querySelector('.character-details ul');
    itemList.appendChild(listItem);
}