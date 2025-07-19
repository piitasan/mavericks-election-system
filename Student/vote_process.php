<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}

$user_id = $_SESSION['student_id'];
$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();

try {
    $pdo->beginTransaction();

    foreach ($positions as $pos) {
        $field = "position_" . $pos['position_id'];
        if (isset($_POST[$field])) {
            $candidate_id = $_POST[$field];

            $stmt = $pdo->prepare("SELECT v.vote_id
                FROM vote_tbl v
                JOIN candidate_tbl c ON v.candidate_id = c.candidate_id
                WHERE v.user_id = :user_id AND c.position_id = :position_id");
            $stmt->execute([
                'user_id' => $user_id,
                'position_id' => $pos['position_id']
            ]);
            $existing_vote = $stmt->fetch();

            if ($existing_vote) {
                echo "❌ You have already voted for " . htmlspecialchars($pos['position_name']) . ".<br>";
            } else {
                $insert = $pdo->prepare("INSERT INTO vote_tbl (user_id, candidate_id) VALUES (:user_id, :candidate_id)");
                $insert->execute([
                    'user_id' => $user_id,
                    'candidate_id' => $candidate_id
                ]);
                echo "✅ Vote for " . htmlspecialchars($pos['position_name']) . " has been submitted.<br>";
            }
        }
    }

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    echo "❌ Error processing vote: " . $e->getMessage();
}

echo "<br><a href='student_dashboard.php'>Back to Dashboard</a>";
?>
