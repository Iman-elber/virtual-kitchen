<?php
// Start the session
session_start();
if (isset($_SESSION['username'])) {
    echo '<a href="logout.php">Logout</a>';
}
// Destroy the session to log the user out
session_unset();  
session_destroy();  

// Redirect the user to the login page or homepage after logout
header("Location: login.php");  
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Kitchen</title>
</head>
<body>

    <header>
        <h1>Welcome to Virtual Kitchen</h1>

        <?php
        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            // If logged in, show the logout link
            echo '<p>Welcome, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
            echo '<a href="logout.php">Logout</a>';
        } else {
            // If not logged in, show the login and register links
            echo '<a href="login.php">Login</a>  <a href="register.php">Register</a>';
        }
        ?>
    </header>

</body>
</html>