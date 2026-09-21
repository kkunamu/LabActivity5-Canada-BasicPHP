<?php
declare(strict_types=1);
session_start();

// Protected route: Gate access if session data is missing
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Handle logout logic directly in the index file to keep file count to 3
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to your Dashboard!</h2>
    <p>You are authenticated as: <strong><?= $_SESSION['user']['email']; ?></strong></p>
    
    <form method="POST">
        <input type="hidden" name="logout" value="1">
        <button type="submit">Log Out</button>
    </form>
</body>
</html>