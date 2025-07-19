<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: student_login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM vote_tbl WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$has_voted = $stmt->fetch();
$already_voted = $has_voted ? true : false;

$stmt = $pdo->prepare("SELECT * FROM election_tbl WHERE CURDATE() BETWEEN start_date AND end_date LIMIT 1");
$stmt->execute();
$election = $stmt->fetch();

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($has_voted) {
        $already_voted = true;
    }

    foreach ($positions as $pos) {
        $field = "position_" . $pos['position_id'];
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $errors[$pos['position_id']] = "❌ Please select a candidate for " . htmlspecialchars($pos['position_name']) . ".";
        }
    }

    if (empty($errors)) {
        try {
            $pdo->beginTransaction();
            $user_id = $_SESSION['user_id'];

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UniVote Voting Page</title>
    <link rel="stylesheet" href="vote.css">
</head>
<body>
    <div id="preloader">
        <div class="loader"></div>
        <p>Loading UniVote...</p>
    </div>

    <div class="container">
        <?php if (!$election): ?>
            <h1>System Notice</h1>
            <div class="error-message" style="margin-top: 20px;">❌ No election is currently active.</div>
            <div class="button-container">
                <a class="back-btn" href="student_dashboard.php">Back to Dashboard</a>
            </div>

        <?php elseif ($already_voted): ?>
            <div id="preloader">
                <div class="loader"></div>
                <p>Loading UniVote...</p>
            </div>
            <h1>Vote for Candidates</h1>
            <h2><?= htmlspecialchars($election['election_name']); ?></h2>
            <div class="error-message">❌ You have already cast your vote.</div>
            <div class="button-container">
                <a class="back-btn" href="view_result.php">View Election Results</a>
                <a class="back-btn" href="student_dashboard.php">Back to Dashboard</a>
            </div>

        <?php elseif (empty($success)): ?>
            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h1>Vote for Candidates</h1>
                <h2><?= htmlspecialchars($election['election_name']); ?></h2>
                <?php foreach ($positions as $pos): ?>
                    <div class="position-block">
                        <h2><?= htmlspecialchars($pos['position_name']); ?></h2>
                        <?php
                        $stmt = $pdo->prepare("SELECT c.*, p.partylist_name FROM candidate_tbl c
                            JOIN partylist_tbl p ON c.partylist_id = p.partylist_id
                            WHERE c.position_id = :pid AND c.election_id = :eid");
                        $stmt->execute(['pid' => $pos['position_id'], 'eid' => $election['election_id']]);
                        $candidates = $stmt->fetchAll();
                        foreach ($candidates as $cand):
                        ?>
                            <label>
                                <input type="radio" name="position_<?= $pos['position_id']; ?>" value="<?= $cand['candidate_id']; ?>"
                                    <?= (isset($_POST["position_" . $pos['position_id']]) && $_POST["position_" . $pos['position_id']] == $cand['candidate_id']) ? "checked" : ""; ?>>
                                <?= htmlspecialchars($cand['full_name']); ?> (<?= htmlspecialchars($cand['partylist_name']); ?>)
                            </label><br>
                        <?php endforeach; ?>

                        <?php if (!empty($errors[$pos['position_id']])): ?>
                            <div class="error-inline"><?= $errors[$pos['position_id']]; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <div class="button-container">
                    <button type="submit" name="submit_vote" class="back-btn">Submit Vote</button>
                    <a class="back-btn" href="student_dashboard.php">Back to Dashboard</a>
                </div>
            </form>

        <?php else: ?>
            <h1>Vote for Candidates</h1>
            <h2><?= htmlspecialchars($election['election_name']); ?></h2>
            <div class="success-message"><?= $success; ?></div>
            <div class="button-container">
                <a class="back-btn" href="student_dashboard.php">Back to Dashboard</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        window.addEventListener("load", () => {
            document.getElementById("preloader").style.display = "none";
        });
    </script>
</body>
</html>
