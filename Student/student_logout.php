<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out</title>
    <link rel="stylesheet" href="student_logout_style.css">
</head>
<body>
<div class="card">
    <h2>You've been logged out</h2>
    <p>Thank you for using the Mavericks Election Portal.</p>
    <a href="student_login.php">🔐 Log In Again</a>
</div>
</body>
</html>