$(document).ready(function () {
    // Event handler for the "Edit" button
    $('.edit-button').on('click', function () {
        var item = $(this).closest('.item');
        var dropdown = item.find('.item-dropdown');
        dropdown.toggle();
    });

    $('.save-button').on('click', function () {
        var item = $(this).closest('.item');
        var itemId = item.find('.item-id').text(); // Get the item ID
        var editForm = item.find('.edit-form');
    
        // Gather updated data from the form
        var editName = editForm.find('input[name="editName"]').val();
        var editId = editForm.find('input[name="editId"]').val();
        var editComment = editForm.find('input[name="editComment"]').val();
    
        // Gather updated conditions data from the form
        var conditions = [];
        editForm.find('.condition-row').each(function () {
            var statName = $(this).find('input[name="editConditionStatName[]"]').val();
            var operator = $(this).find('input[name="editConditionOperator[]"]').val();
            var value = $(this).find('input[name="editConditionValue[]"]').val();
            conditions.push(statName + ' ' + operator + ' ' + value);
        });

        // Check if conditions array has data
        if (conditions.length === 0) {
            alert('Please add conditions before saving.');
            return;
        }
    
        // Perform an AJAX request to add/update the data on the server
        var updateEndpoint = '/pages/helpers/update_item_condition.php';
        $.ajax({
            type: 'POST',
            url: updateEndpoint,
            data: JSON.stringify({
                itemId: itemId,
                editName: editName,
                editId: editId,
                editComment: editComment,
                conditions: conditions
            }),
            contentType: 'application/json',
            success: function (response) {
                // Handle success response
                console.log('Update successful:', response);
    
                // Show success message overlay for 5 seconds
                showMessageOverlay('Update successful', 5000);
    
                // Close the edit form or provide feedback to the user
                // You might want to hide the form, show a success message, or reload the page
                item.find('.item-dropdown').hide();
    
                // Hide the message overlay after 5 seconds
                setTimeout(hideMessageOverlay, 5000);
            },
            error: function (error) {
                // Handle error response
                console.error('Error updating item:', error);
    
                // Show error message overlay for 5 seconds
                showMessageOverlay('Error updating item: ' + error.responseJSON.message, 5000);
    
                // You might want to show an error message to the user
    
                // Hide the message overlay after 5 seconds
                setTimeout(hideMessageOverlay, 5000);
            }
        });
    });
});

// Function to show a message overlay with a countdown timer
function showMessageOverlay(message, duration) {
    var overlay = document.createElement('div');
    overlay.classList.add('message-overlay');

    // Add content with proper HTML structure for styling
    overlay.innerHTML = `
        <h2>${message}</h2>
        <p>Redirecting back to Conditions in <span id="countdown">${Math.floor(duration / 1000)}</span> seconds.</p>
    `;

    //<button id="cancelButton">Cancel</button>

    document.body.appendChild(overlay);

    // Countdown timer
    var seconds = Math.floor(duration / 1000);
    var countdownSpan = document.getElementById('countdown');

    var timer = setInterval(function () {
        seconds--;
        countdownSpan.textContent = seconds;

        if (seconds <= 0) {
            clearInterval(timer);
            // Set the flag to indicate countdown completion
            overlay.countdownComplete = true;
            hideMessageOverlay();
            // Reload the page only if the countdown has completed
            if (overlay.countdownComplete) {
                window.location.href = '/pages/item_conditions.php';
            }
        }
    }, 1000);

    // Add event listener for the Cancel button
    document.getElementById('cancelButton').addEventListener('click', cancelReload);
}

// Function to hide the message overlay
function hideMessageOverlay() {
    var overlay = document.querySelector('.message-overlay');
    if (overlay) {
        clearInterval(overlay.timer); // Clear the countdown timer

        // Check if the overlay has a cancel button
        var cancelButton = overlay.querySelector('button');
        if (cancelButton) {
            // Remove the event listener for the cancel button
            cancelButton.removeEventListener('click', cancelReload);
        }

        overlay.parentNode.removeChild(overlay);
    }
}

// Function to cancel the page reload
function cancelReload() {
    var overlay = document.querySelector('.message-overlay');
    if (overlay) {
        // Set the flag to indicate cancellation
        overlay.countdownComplete = false;
        hideMessageOverlay();
    }
}


// Function to edit item condition using AJAX
function editItemCondition(itemId, editName, editId, editComment, conditions) {
    // Create an object with the edited data
    const editData = {
        itemId: itemId,
        editName: editName,
        editId: editId,
        editComment: editComment,
        conditions: conditions
    };

    // Use AJAX to send the data to the server for editing
    $.ajax({
        type: 'POST',
        url: '/pages/helpers/update_item_condition.php',
        data: JSON.stringify(editData),
        contentType: 'application/json',
        success: function (response) {
            // Handle success response
            console.log('Update successful:', response);

            // Close the edit form or provide feedback to the user
            // You might want to hide the form, show a success message, or reload the page
            const item = $(`.item:has(.item-id:contains(${itemId}))`);
            item.find('.item-dropdown').hide();

            // Display a success message overlay for 5 seconds
            showMessageOverlay('Edit successful', 5000);
        },
        error: function (error) {
            // Handle error response
            console.error('Error updating item:', error);

            // Display an error message overlay for 5 seconds
            showMessageOverlay('Error updating item: ' + error.responseJSON.message, 5000, hideMessageOverlay);
        }
    });
}





function toggleAddItemForm() {
    var addItemForm = document.getElementById('addItemForm');
    addItemForm.style.display = addItemForm.style.display === 'none' ? 'block' : 'none';
}


// Function to open the add item modal
function openAddItemModal() {
    var modal = document.getElementById('addItemModal');
    modal.style.display = 'block';
}

// Function to close the add item modal
function closeAddItemModal() {
    var modal = document.getElementById('addItemModal');
    modal.style.display = 'none';
}

// Function to toggle the modal and update button text
function toggleAddItemModal() {
    var modalContainer = document.getElementById('modalContainerItem');
    var buttonTextElement = document.getElementById('addItemButton');

    console.log('modalContainer:', modalContainer);
    console.log('buttonTextElement:', buttonTextElement);

    modalContainer.classList.toggle('show');

    // Update button text based on modal state
    // Verify that buttonTextElement is not null before using it
    if (buttonTextElement) {
        buttonTextElement.innerText = modalContainer.classList.contains('show') ? 'Cancel' : 'Add Item';
    } else {
        console.error('buttonTextElement is null.');
    }

}



function addItem() {
    // Get item data from the form
    const referenceId = document.getElementById('referenceId').value;
    const itemType = document.getElementById('itemType').value;
    const itemName = document.getElementById('itemName').value;
    const conditionType = document.getElementById('conditionType').value;
    let conditions = document.getElementById('conditions').value;

    // Remove square brackets from conditions
    conditions = conditions.replace(/\[|\]/g, '');

    // Check if item name is empty
    if (itemName.trim() === '') {
        // Display an error message for empty item name
        alert('Please enter an item name.');
        return;
    }

    // Create an object with the item data
    const itemData = {
        referenceId: referenceId, // Use referenceId as item_id
        itemType: itemType,
        itemName: itemName,
        conditionType: conditionType,
        conditions: conditions.trim() !== '' ? conditions : null // Use null if conditions are empty
    };

    // Use AJAX to send the data to the server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/pages/helpers/add_item_condition.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Parse the JSON response
                const response = JSON.parse(xhr.responseText);

                // Check if the item was added successfully
                if (response.success) {
                    // Log success and response
                    console.log('Item added successfully. Response:', response);

                    // Display a success message overlay
                    showMessageOverlay('Item added successfully!', 4000);
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

    // Convert the item data object to JSON and send it in the request body
    xhr.send(JSON.stringify(itemData));

    // For now, just toggle the modal visibility
    toggleAddItemModal();
}





// Initial call to populate options based on the default selected item type
//updateItemTypeOptions();
