<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM vote_tbl WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['student_id']]);
$has_voted = $stmt->fetch();

if ($has_voted) {
    echo "You have already cast your vote.";
    echo "<br><a href='logout.php'>Logout</a>";
    exit;
}

$election = $pdo->query("SELECT * FROM election_tbl LIMIT 1")->fetch();

if (!$election) {
    echo "No election setup yet.";
    exit;
}

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Vote</title></head>
<body>
    <h2>Vote for Candidates - <?= $election['election_name']; ?></h2>
    <form method="POST" action="vote_process.php">
        <?php foreach ($positions as $pos): ?>
            <h4><?= $pos['position_name']; ?></h4>
            <?php
            $stmt = $pdo->prepare("SELECT c.*, p.partylist_name FROM candidate_tbl c
            JOIN partylist_tbl p ON c.partylist_id = p.partylist_id
            WHERE c.position_id = :pid AND c.election_id = :eid");
            $stmt->execute(['pid' => $pos['position_id'], 'eid' => $election['election_id']]);
            $candidates = $stmt->fetchAll();
            foreach ($candidates as $cand):
            ?>
                <input type="radio" name="position_<?= $pos['position_id']; ?>" value="<?= $cand['candidate_id']; ?>" required>
                <?= $cand['full_name']; ?> (<?= $cand['partylist_name']; ?>)<br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <button type="submit" name="submit_vote">Submit Vote</button>
    </form>
    <br><a href="logout.php">Logout</a>
</body>
</html>
