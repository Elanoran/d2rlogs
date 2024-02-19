<?php
include_once __DIR__ . '/../../config.php';
$conn = connectDB();
// Include the file with runAreas
include 'run_areas.php';

// Query to fetch bots with area names
$sql = "SELECT b.id, b.bot_name, b.running_char, b.last_seen, b.game_number, b.start_time, b.run_list, a.area_name 
        FROM bots b
        LEFT JOIN areas a ON b.in_area = a.area_number";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='bot-container'>";
    while ($row = $result->fetch_assoc()) {
        // Parse the start_time string
        $startTime = new DateTime($row['start_time']);

        // Parse the last_seen string
        $lastSeen = new DateTime($row['last_seen']);

        // Get the current date
        $currentDate = new DateTime();

        // Calculate the difference in minutes
        $interval = $lastSeen->diff($currentDate);
        $minutesDiff = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;

        // Format the last seen timestamp
        $formattedLastSeen = '';

        if ($minutesDiff > 5) {
            // Bot is offline for more than 15 minutes, display offline card
            $formattedLastSeen = $lastSeen->format('Y-m-d H:i:s'); // Display full timestamp for offline card

            echo "<div class='bot-card' data-bot-id='{$row["id"]}' data-start-time='{$startTime->getTimestamp()}'>" . 
                "<h3>" . $row["bot_name"] . "</h3>" . 
                "<p class='character-info'>" . 
                "<div class='offline-message'>Bot is currently offline</div>" . "<br>" .// Offline message
                "Last Seen: " . $formattedLastSeen .
                "<p class='run-time'></p>" .
            "</div>";
        } else {
            // Bot is online, display regular card
            echo "<div class='bot-card' data-bot-id='{$row["id"]}' data-start-time='{$startTime->getTimestamp()}'>" . 
                "<h3>" . $row["bot_name"] . "<span class='run-time'></span></h3>" . 
                "<p class='character-info'>" . 
                "Character: <a href='character-details.php?name=" . urlencode($row["running_char"]) . "'>" . $row["running_char"] . "</a><br>" .
                //"Last Seen: Today at " . $lastSeen->format('H:i') . "<br>" . // Default format for online bots
                "Game Number: " . $row["game_number"] . "<br>" .
                "<span class='run-list'><br>Running: </span>" .  
                "<ul class='run-list'>";

                // Determine the current run based on the bot's area
                $currentRun = "";
                foreach ($runAreas as $runName => $areas) {
                    if (in_array($row["area_name"], $areas)) {
                        $currentRun = $runName;
                        break;
                    }
                }

                // Extract run_list from the database
                $runList = explode(", ", $row["run_list"]);

                // Display each run in the run list
                foreach ($runAreas as $runName => $areas) {
                    $isCurrentRun = ($runName == $currentRun);
                    $isRunInRunList = in_array($runName, $runList);

                    // Apply color for the current run and check if it's part of run_list
                    $runItemClass = $isCurrentRun ? 'current-run' : ($isRunInRunList ? 'in-run-list' : '');
                    $runItemArea = $isCurrentRun ? " - " . $row["area_name"] : '';

                    echo "<li class='run-list-item $runItemClass'>$runName$runItemArea</li>";
                }

                echo "</ul>" .
                "</p>" .
            "</div>";
        }
    }
    echo "</div>";
} else {
    echo "<p class='no-records'>No records found</p>";
}

//$conn->close();
?>
