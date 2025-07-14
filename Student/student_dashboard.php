<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: student_login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM user_tbl WHERE user_id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$student = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>!</h2>

    <ul>
        <li><a href="vote.php">Cast Your Vote</a></li>
        <li><a href="view_result.php">View Election Results</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
