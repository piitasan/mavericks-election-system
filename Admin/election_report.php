<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$candidates = $pdo->query("SELECT c.full_name, p.position_name, pl.partylist_name, COUNT(v.vote_id) as total_votes
    FROM candidate_tbl c
    JOIN position_tbl p ON c.position_id = p.position_id
    JOIN partylist_tbl pl ON c.partylist_id = pl.partylist_id
    LEFT JOIN vote_tbl v ON c.candidate_id = v.candidate_id
    GROUP BY c.candidate_id
    ORDER BY p.position_id")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Election Reports</title></head>
<body>
    <h2>Election Results Report</h2>
    <table border="1">
        <tr>
            <th>Candidate</th>
            <th>Position</th>
            <th>Partylist</th>
            <th>Total Votes</th>
        </tr>
        <?php foreach ($candidates as $c): ?>
        <tr>
            <td><?= $c['full_name']; ?></td>
            <td><?= $c['position_name']; ?></td>
            <td><?= $c['partylist_name']; ?></td>
            <td><?= $c['total_votes']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
