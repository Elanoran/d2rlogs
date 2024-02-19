<!-- templates/header-template.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D2R Logs</title>
    <!-- Common CSS -->
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/vendors/fontawesome-6.5.1/css/all.min.css">

    <!-- Page-specific CSS (you can add more based on the needs of specific pages) -->
    <?php
        if (isset($pageCSS)) {
            echo "<link rel='stylesheet' href='" . BASE_PATH . "assets/css/{$pageCSS}.css'>";
            echo "<script defer src='" . BASE_PATH . "assets/js/{$pageCSS}.js'></script>";
            if ($pageCSS === 'conditions') {
                echo "<script src='" . BASE_PATH . "assets/vendors/jquery/jquery-3.7.1.min.js'></script>";
            }

        }
    ?>

    <title>Your Website Title</title>
</head>
<body>

<div id="wrapper">
<div id="banner">
    <h1>Diablo® II: Resurrected Logs</h1>
</div>

<div id="menu">
    <a href="../index.php" <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="current"'; ?>>Home</a>
    <a href="../pages/logs.php" <?php if(basename($_SERVER['PHP_SELF']) == 'logs.php') echo 'class="current"'; ?>>D2RLogs</a>
    <a href="../pages/character-list.php" <?php if(basename($_SERVER['PHP_SELF']) == 'character-list.php') echo 'class="current"'; ?>>Characters</a>
    <a href="../pages/item_conditions.php" <?php if(basename($_SERVER['PHP_SELF']) == 'item_conditions.php') echo 'class="current"'; ?>>Conditions</a>
    <a href="../pages/about.php" <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="current"'; ?>>About</a>
</div>