<?php

// Function to get character data based on character name
function getCharacterData($conn, $characterName) {
    $sql = "SELECT * FROM characters WHERE character_name = '$characterName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to get items for a character based on character name
function getCharacterItems($conn, $characterName) {
    $sql = "SELECT * FROM items WHERE bot_char_name = '$characterName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return null;
    }
}

function getCharacterList($conn) {
    $characters = array();

    $sql = "SELECT * FROM characters";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $characters[] = $row;
        }
    }

    return $characters;
}

function getCharacterDetails($conn, $characterName) {
    $characterDetails = array();

    $sql = "SELECT * FROM characters WHERE character_name = '$characterName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $characterDetails = $result->fetch_assoc();
    }

    return $characterDetails;
}

// Function to get background color based on character class
function getBackgroundColor($characterClass) {
    switch ($characterClass) {
        case 'amazon':
            return '#ff9900'; // Orange for Warrior
        case 'assassin':
            return '#3366cc'; // Blue for Mage
        case 'barbarian':
            return '#999966'; // Grey for Rogue
        // Add more cases for other classes as needed
        default:
            return '#cccccc'; // Default color
    }
}

// Function to get background image URL based on character class
function getBackgroundImage($characterClass) {
    // Convert the character class to lowercase
    $lowercaseClass = strtolower($characterClass);
    // Add logic to map character class to image URL
    switch ($lowercaseClass) {
        case 'amazon':
            return '../assets/images/amazon-cover.png';
        case 'assassin':
            return '../assets/images/assassin-cover.png';
        case 'barbarian':
            return '../assets/images/barbarian-cover.png';
        case 'druid':
            return '../assets/images/druid-cover.png';
        case 'necromancer':
            return '../assets/images/necromancer-cover.png';
        case 'paladin':
            return '../assets/images/paladin-cover.png';
        case 'sorceress':
            return '../assets/images/sorceress-cover.png';
        // Add more cases for other classes as needed
        default:
            return '../assets/images/default-cover.png'; // Default image
    }
}

// Function to get background image URL based on character class
function getCharacterBackgroundImage($characterClass) {
    // Convert the character class to lowercase
    $lowercaseClass = strtolower($characterClass);
    // Add logic to map character class to image URL
    switch ($lowercaseClass) {
        case 'amazon':
            return '../assets/images/amazon-character-details.png';
        case 'assassin':
            return '../assets/images/assassin-character-details.png';
        case 'barbarian':
            return '../assets/images/barbarian-character-details.png';
        case 'druid':
            return '../assets/images/druid-character-details.png';
        case 'necromancer':
            return '../assets/images/necromancer-character-details.png';
        case 'paladin':
            return '../assets/images/paladin-character-details.png';
        case 'sorceress':
            return '../assets/images/sorceress-character-details.png';
        // Add more cases for other classes as needed
        default:
            return '../assets/images/backdrop-character-details.png'; // Default image
    }
}

?>