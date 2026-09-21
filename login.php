<?php
declare(strict_types=1);
session_start();

// Unprotected route: Redirect to index if already authenticated
if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Handle backend session creation after client-side validation passes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    if (!empty($email)) {
        $_SESSION['user'] = [
            'email' => htmlspecialchars($email)
        ];
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <p id="error-message" style="color: red; display: none;">Incorrect email. Please register or try again.</p>
    
    <form id="loginForm" method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const registeredEmail = localStorage.getItem('registeredEmail');
            const inputEmail = document.getElementById('email').value;
            const errorMsg = document.getElementById('error-message');

            // Client-side validation against localStorage
            if (inputEmail !== registeredEmail) {
                e.preventDefault(); // Stop POST request to PHP
                errorMsg.style.display = 'block';
            }
        });
    </script>
</body>
</html>