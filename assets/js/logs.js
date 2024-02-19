// Variable to track whether automatic refresh is allowed
var allowRefresh = true;

// Function to check if the current page is 1
function isPageOne() {
    // Check if the checkbox is checked
    var autoRefreshCheckbox = document.getElementById("autoRefreshCheckbox");
    var isAutoRefreshEnabled = autoRefreshCheckbox ? autoRefreshCheckbox.checked : true;

    // Check if the current page is 1 before performing automatic refresh
    if (isAutoRefreshEnabled) {
        var urlParams = new URLSearchParams(window.location.search);
        var currentPage = parseInt(urlParams.get('page')) || 1;
        return currentPage === 1;
    }

    return false;
}


// Function to update run timers
function updateRunTimers() {
    // Get all bot cards
    var botCards = document.querySelectorAll('.bot-card');

    // Iterate over each bot card
    botCards.forEach(function(botCard) {
        // Get the start time from the data attribute
        var startTime = parseInt(botCard.getAttribute('data-start-time'));

        // Calculate the run time using client-side clock
        var currentTime = Math.floor(Date.now() / 1000); // in seconds
        var runTime = currentTime - startTime;

        // Make sure runTime is not negative
        runTime = Math.max(0, runTime);

        // Format run time dynamically
        var formattedRunTime = formatRunTime(runTime);

        // Update the run time in the bot card
        var runTimeElement = botCard.querySelector('.run-time');
        
        if (runTimeElement) {
            // Check if the bot is offline
            var offlineMessage = botCard.querySelector('.offline-message');
            var isOffline = offlineMessage && offlineMessage.style.display !== 'none';

            // Conditionally hide or show the run time based on bot's online/offline status
            runTimeElement.textContent = isOffline ? '' : ' - ' + formattedRunTime;
        }
    });
}

// Function to dynamically format run time
function formatRunTime(seconds) {
    if (seconds < 60) {
        return seconds + ' sec';
    } else if (seconds < 3600) {
        var minutes = Math.floor(seconds / 60);
        var remainingSeconds = seconds % 60;
        return minutes + ' min ' + (remainingSeconds > 0 ? remainingSeconds + ' sec' : '');
    } else {
        var hours = Math.floor(seconds / 3600);
        var remainingMinutes = Math.floor((seconds % 3600) / 60);
        return hours + ' hours ' + (remainingMinutes > 0 ? remainingMinutes + ' min' : '');
    }
}

function updateBots() {
    // Get the existing bot container
    var botContainer = document.querySelector('.bot-container');

    // Fetch the content from get_bots.php
    fetch('/pages/helpers/get_bots.php')
        .then(response => response.text())
        .then(data => {
            // Create a temporary container to parse the new data
            var tempContainer = document.createElement('div');
            tempContainer.innerHTML = data;

            // Remove all existing bot cards
            while (botContainer.firstChild) {
                botContainer.removeChild(botContainer.firstChild);
            }

            // Append the new bot cards
            tempContainer.childNodes.forEach(function (newBotCard) {
                botContainer.appendChild(newBotCard.cloneNode(true));
            });

            // Update run timers after updating bot cards
            updateRunTimers();
        })
        .catch(error => console.error('Error:', error));
}

// Call the initial update when the page is loaded
updateBots();
updateRunTimers(); // Call this here to ensure it runs when the page loads

// Set an interval to update the bots every X milliseconds
setInterval(function () {
    updateBots();
    updateRunTimers(); // Call updateRunTimers within the interval loop
}, 5000); // Update every 5 seconds, adjust as needed

// Add other event listeners or functions as needed


// Function to refresh logs
function refreshLogs() {
    //console.log("Checking for refresh...");
    
    // Check if automatic refresh is allowed
    if (allowRefresh && isPageOne()) {
        //console.log("Refreshing logs for page 1...");
        
        // Use AJAX to fetch the updated content
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Update the list content
                document.getElementById("logsList").innerHTML = this.responseText;

                // Update the current page display
                var currentPage = document.getElementById("currentPage");
                if (currentPage) {
                    currentPage.innerHTML = "Current Page: " + getCurrentPage();
                }
            }
        };
        xhttp.open("GET", "/pages/helpers/get_logs.php", true);
        xhttp.send();
    } else {
        //console.log("Not refreshing on other pages or refresh is disabled.");
    }
}

// Function to get the current page from the URL
function getCurrentPage() {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('page') || 1;
}

// Load logs on page load
refreshLogs();
updateBots();

// Automatic refresh every 5 seconds (adjust as needed)
setInterval(refreshLogs, 5000);
setInterval(updateBots, 3000);

// Function to handle the checkbox toggle
function toggleRefresh() {
    allowRefresh = !allowRefresh;
    //console.log("Automatic refresh toggled: " + allowRefresh);
}

// Attach the toggleRefresh function to the checkbox change event
//document.getElementById("autoRefreshCheckbox").addEventListener("change", toggleRefresh);

// Function to load logs when clicking on pagination links
function loadLogs(page) {
    // Use AJAX to fetch the updated content with the specified page
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Update the list content
            document.getElementById("logsList").innerHTML = this.responseText;

            // Update the current page display
            var currentPage = document.getElementById("currentPage");
            if (currentPage) {
                currentPage.innerHTML = "Current Page: " + page;
            }
        }
    };
    xhttp.open("GET", "/pages/helpers/get_logs.php?page=" + page, true);
    xhttp.send();
}
