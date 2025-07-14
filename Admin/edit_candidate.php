<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $position_id = $_POST['position_id'];
    $partylist_id = $_POST['partylist_id'];
    $election_id = $_POST['election_id'];

    $stmt = $pdo->prepare("UPDATE candidates SET full_name = :full_name, position_id = :position_id, partylist_id = :partylist_id, election_id = :election_id WHERE candidate_id = :id");
    $stmt->execute([
        'full_name' => $full_name,
        'position_id' => $position_id,
        'partylist_id' => $partylist_id,
        'election_id' => $election_id,
        'id' => $id
    ]);
    header("Location: candidate_maintenance.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM candidate_tbl WHERE candidate_id = :id");
$stmt->execute(['id' => $id]);
$candidate = $stmt->fetch();

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();
$partylists = $pdo->query("SELECT * FROM partylist_tbl")->fetchAll();
$elections = $pdo->query("SELECT * FROM election_tbl")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Candidate</title></head>
<body>
    <h2>Edit Candidate</h2>
    <form method="POST">
        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?= $candidate['full_name']; ?>" required><br>

        <label>Position:</label>
        <select name="position_id">
            <?php foreach ($positions as $pos): ?>
                <option value="<?= $pos['position_id']; ?>" <?= ($pos['position_id'] == $candidate['position_id']) ? 'selected' : ''; ?>>
                    <?= $pos['position_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Partylist:</label>
        <select name="partylist_id">
            <?php foreach ($partylists as $pl): ?>
                <option value="<?= $pl['partylist_id']; ?>" <?= ($pl['partylist_id'] == $candidate['partylist_id']) ? 'selected' : ''; ?>>
                    <?= $pl['partylist_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Election:</label>
        <select name="election_id">
            <?php foreach ($elections as $el): ?>
                <option value="<?= $el['election_id']; ?>" <?= ($el['election_id'] == $candidate['election_id']) ? 'selected' : ''; ?>>
                    <?= $el['election_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit" name="update">Update</button>
    </form>
    <br><a href="candidate_maintenance.php">Back</a>
</body>
</html>
