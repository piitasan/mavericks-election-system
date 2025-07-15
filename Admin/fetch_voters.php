<?php
require 'db_connect.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM user_tbl WHERE role='student' AND (student_id LIKE :search OR first_name LIKE :search OR middle_initial LIKE :search OR last_name LIKE :search) ORDER BY student_id ASC");
    $stmt->execute(['search' => "%$search%"]);
    $voters = $stmt->fetchAll();
} else {
    $voters = $pdo->query("SELECT * FROM user_tbl WHERE role='student' ORDER BY student_id ASC")->fetchAll();
}

foreach ($voters as $voter) {
    echo "<tr>
        <td>".htmlspecialchars($voter['student_id'])."</td>
        <td>".htmlspecialchars($voter['first_name'])."</td>
        <td>".htmlspecialchars($voter['middle_initial'])."</td>
        <td>".htmlspecialchars($voter['last_name'])."</td>
        <td>".htmlspecialchars($voter['suffix'])."</td>
        <td>".htmlspecialchars($voter['section'])."</td>
        <td>".htmlspecialchars($voter['course'])."</td>
        <td>".htmlspecialchars($voter['year_level'])."</td>
        <td><a href='view_voter.php?id=".urlencode($voter['student_id'])."'>View Voter</a></td>
    </tr>";
}
