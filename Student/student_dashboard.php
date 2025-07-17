<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}
$student_id = $_SESSION['student_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="student_dashboard_style.css">
</head>
<body>
<div class="dashboard">
    <h2>Student Dashboard</h2>
    <div class="welcome">Welcome, Student ID: <strong><?= htmlspecialchars($student_id) ?></strong></div>

    <a href="vote.php" class="button">🗳️ Cast Your Vote</a>
    <a href="view_result.php" class="button">📊 View Election Results</a>
    <a href="student_logout.php" class="button">🚪 Logout</a>

    <div class="footer">Mavericks Election Portal &copy; 2025</div>
</div>
</body>
</html>
