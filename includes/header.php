<?php
// includes/header.php

// function to determine user role (you can replace this with your authentication logic)
function getUserRole() {
    return 'guest'; // For simplicity, assuming a guest user
}

// navigation menu based on user role
function generateNavigation() {
    $userRole = getUserRole();

    if ($userRole === 'guest') {
        return '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
    } else {
        return '<a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a>';
    }
}

// Include header content specific to each page
?>
<header>
    <h1>Welcome to My Website</h1>
    <nav>
        <?php echo generateNavigation(); ?>
    </nav>
</header>