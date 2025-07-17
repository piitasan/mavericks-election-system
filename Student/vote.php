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

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($positions as $pos) {
        $field = "position_" . $pos['position_id'];
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $errors[] = "❌ Please select a candidate for " . htmlspecialchars($pos['position_name']) . ".";
        }
    }

    if (empty($errors)) {
        try {
            $pdo->beginTransaction();
            $user_id = $_SESSION['student_id'];

            foreach ($positions as $pos) {
                $field = "position_" . $pos['position_id'];
                $candidate_id = $_POST[$field];

                $insert = $pdo->prepare("INSERT INTO vote_tbl (user_id, candidate_id) VALUES (:user_id, :candidate_id)");
                $insert->execute([
                    'user_id' => $user_id,
                    'candidate_id' => $candidate_id
                ]);
            }

            $pdo->commit();
            $success = "✅ Your votes have been submitted successfully.";
        } catch (Exception $e) {
            $pdo->rollBack();
            $errors[] = "❌ Error processing your votes: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote</title>
    <style>
        .error {
            color: red;
            margin-bottom: 5px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Vote for Candidates - <?= htmlspecialchars($election['election_name']); ?></h2>

    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $e): ?>
            <div class="error"><?= $e; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?= $success; ?></div>
    <?php endif; ?>

    <?php if (empty($success)): ?>
    <form method="POST">
        <?php foreach ($positions as $pos): ?>
            <h4><?= htmlspecialchars($pos['position_name']); ?></h4>
            <?php
            $stmt = $pdo->prepare("SELECT c.*, p.partylist_name FROM candidate_tbl c
            JOIN partylist_tbl p ON c.partylist_id = p.partylist_id
            WHERE c.position_id = :pid AND c.election_id = :eid");
            $stmt->execute(['pid' => $pos['position_id'], 'eid' => $election['election_id']]);
            $candidates = $stmt->fetchAll();
            foreach ($candidates as $cand):
            ?>
                <input type="radio" name="position_<?= $pos['position_id']; ?>" value="<?= $cand['candidate_id']; ?>"
                <?= (isset($_POST["position_" . $pos['position_id']]) && $_POST["position_" . $pos['position_id']] == $cand['candidate_id']) ? "checked" : ""; ?>>
                <?= htmlspecialchars($cand['full_name']); ?> (<?= htmlspecialchars($cand['partylist_name']); ?>)<br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <button type="submit" name="submit_vote">Submit Vote</button>
    </form>
    <?php endif; ?>

    <br><a href="logout.php">Logout</a>
</body>
</html>
