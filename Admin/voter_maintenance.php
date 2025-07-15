<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$voters = $pdo->query("SELECT * FROM user_tbl WHERE role='student'")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voter Maintenance</title>
</head>
<body>
    <h2>Voter Maintenance</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>MI</th>
            <th>Lastname</th>
            <th>Suffix</th>
            <th>Section</th>
            <th>Course</th>
            <th>Yearlevel</th>
            <th>Action</th>
        </tr>
        <?php foreach ($voters as $voter): ?>
        <tr>
            <td><?= $voter['student_id']; ?></td>
            <td><?= $voter['first_name']; ?></td>
            <td><?= $voter['middle_initial']; ?></td>
            <td><?= $voter['last_name']; ?></td>
            <td><?= $voter['suffix']; ?></td>
            <td><?= $voter['section']; ?></td>
            <td><?= $voter['course']; ?></td>
            <td><?= $voter['year_level']; ?></td>
            <td>
                <a href="view_voter.php?id=<?= $voter['student_id']; ?>">View Voter</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
