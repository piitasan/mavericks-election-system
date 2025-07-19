<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logging out of UniVote</title>
    <link rel="stylesheet" href="student_logout_style.css">
</head>
<body>
    <div id="preloader">
    <div class="loader"></div>
    <p> Loading UniVote...</p>
    </div>

    <div class="card">
    <h2>You've been logged out</h2>
    <p>Thank you for using UniVote!</p>
    <a href="student_login.php">🔐 Log In Again</a>
    </div>
<script>
    window.addEventListener("load", () => {
    document.getElementById("preloader").style.display = "none";
});
</script>
</body>
</html>