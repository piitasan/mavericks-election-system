<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT 
        c.full_name AS candidate_name,
        p.partylist_name,
        COUNT(v.vote_id) AS total_votes
    FROM candidate_tbl c
    LEFT JOIN vote_tbl v ON c.candidate_id = v.candidate_id
    JOIN partylist_tbl p ON c.partylist_id = p.partylist_id
    GROUP BY c.candidate_id, c.full_name, p.partylist_name
    ORDER BY total_votes DESC
");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$filename = "election_summary_report_" . date("Y-m-d_H-i-s") . ".csv";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

if (!empty($results)) {
    fputcsv($output, array_keys($results[0]));
    foreach ($results as $row) {
        fputcsv($output, $row);
    }
} else {
    fputcsv($output, ['No data found']);
}

fclose($output);
exit;
?>
