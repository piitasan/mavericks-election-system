<?php
require 'db_connect.php';

$sql = "
SELECT p.position_name, c.full_name, pt.partylist_name, COUNT(v.vote_id) AS total_votes
FROM candidate_tbl c
JOIN position_tbl p ON c.position_id = p.position_id
JOIN partylist_tbl pt ON c.partylist_id = pt.partylist_id
LEFT JOIN vote_tbl v ON c.candidate_id = v.candidate_id
GROUP BY c.candidate_id
ORDER BY p.position_id, total_votes DESC
";

$stmt = $pdo->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grouped = [];
foreach ($results as $row) {
    $grouped[$row['position_name']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UniVote Student Candidate</title>
    <link rel="stylesheet" href="view_result_style.css">
</head>
<body>
<div class="container">
    <h1>Candidate List</h1>
    <?php foreach ($grouped as $position => $candidates): ?>
        <h2><?= htmlspecialchars($position) ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th>Position</th>
                    <th>Partylist</th>
                    <th>Total Votes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidates as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                        <td><?= htmlspecialchars($position) ?></td>
                        <td><?= htmlspecialchars($row['partylist_name']) ?></td>
                        <td><?= $row['total_votes'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
    <div class="button-container">
        <a class="back-btn" href="student_dashboard.php">Back to Dashboard</a>
    </div>
</div>
</body>
</html>