<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "No voter selected.";
    exit;
}

$voter_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM user_tbl WHERE student_id = ?");
$stmt->execute([$voter_id]);
$voter = $stmt->fetch();

if (!$voter) {
    echo "Voter not found.";
    exit;
}

$user_id = $voter['user_id'];

$stmt = $pdo->prepare("
    SELECT c.full_name AS candidate_full, p.position_name
    FROM vote_tbl v
    JOIN candidate_tbl c ON v.candidate_id = c.candidate_id
    JOIN position_tbl p ON c.position_id = p.position_id
    WHERE v.user_id = ?
");
$stmt->execute([$user_id]);
$votes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voter Votes</title>
</head>
<body>
    <h2>Votes Casted by <?= htmlspecialchars($voter['first_name'] . ' ' . $voter['last_name']); ?></h2>

    <?php if (count($votes) > 0): ?>
        <table border="1">
            <tr>
                <th>Position</th>
                <th>Candidate Voted</th>
            </tr>
            <?php foreach ($votes as $vote): ?>
            <tr>
                <td><?= htmlspecialchars($vote['position_name']); ?></td>
                <td><?= htmlspecialchars($vote['candidate_full']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>This voter has not voted yet.</p>
    <?php endif; ?>

    <br>
    <a href="voter_maintenance.php">Back to Voter Maintenance</a>
</body>
</html>
