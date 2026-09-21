<?php
declare(strict_types=1);
session_start();

// Unprotected route: Redirect to index if already authenticated
if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register Account</h2>
    <form id="registerForm">
        <label for="email">Email:</label>
        <input type="email" id="email" required>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            
            // Save email to localStorage for simplicity per requirements
            localStorage.setItem('registeredEmail', email);
            
            alert('Registration successful! Proceeding to login.');
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>