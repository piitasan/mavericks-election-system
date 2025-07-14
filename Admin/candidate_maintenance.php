<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['add'])) {
    $full_name = $_POST['full_name'];
    $position_id = $_POST['position_id'];
    $partylist_id = $_POST['partylist_id'];
    $election_id = $_POST['election_id'];

    $stmt = $pdo->prepare("INSERT INTO candidate_tbl (full_name, position_id, partylist_id, election_id)
                           VALUES (:full_name, :position_id, :partylist_id, :election_id)");
    $stmt->execute([
        'full_name' => $full_name,
        'position_id' => $position_id,
        'partylist_id' => $partylist_id,
        'election_id' => $election_id
    ]);

    $action = "Added a New Candidate: $full_name";
    $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
    $stmt->execute([$_SESSION['admin_id'], $action]);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("SELECT full_name FROM candidate_tbl WHERE candidate_id = :id");
    $stmt->execute(['id' => $id]);
    $candidate = $stmt->fetch();

    $stmt = $pdo->prepare("DELETE FROM candidate_tbl WHERE candidate_id = :id");
    $stmt->execute(['id' => $id]);

    if ($candidate) {
        $action = "Deleted Candidate: " . $candidate['full_name'];
        $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $action]);
    }
}

$candidates = $pdo->query("
    SELECT c.*, p.position_name, pl.partylist_name
    FROM candidate_tbl c
    JOIN position_tbl p ON c.position_id = p.position_id
    JOIN partylist_tbl pl ON c.partylist_id = pl.partylist_id
")->fetchAll();

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();
$partylists = $pdo->query("SELECT * FROM partylist_tbl")->fetchAll();
$elections = $pdo->query("SELECT * FROM election_tbl")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Candidate Maintenance</title></head>
<body>
    <h2>Candidate Maintenance</h2>
    <form method="POST">
        <label>Full Name:</label><input type="text" name="full_name" required><br>
        <label>Position:</label>
        <select name="position_id" required>
            <?php foreach ($positions as $pos): ?>
                <option value="<?= $pos['position_id']; ?>"><?= $pos['position_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Partylist:</label>
        <select name="partylist_id" required>
            <?php foreach ($partylists as $pl): ?>
                <option value="<?= $pl['partylist_id']; ?>"><?= $pl['partylist_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Election:</label>
        <select name="election_id" required>
            <?php foreach ($elections as $el): ?>
                <option value="<?= $el['election_id']; ?>"><?= $el['election_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit" name="add">Add Candidate</button>
    </form>

    <h3>Existing Candidates</h3>
    <table border="1">
        <tr>
            <th>ID</th><th>Name</th><th>Position</th><th>Party</th><th>Action</th>
        </tr>
        <?php foreach ($candidates as $cand): ?>
        <tr>
            <td><?= $cand['candidate_id']; ?></td>
            <td><?= $cand['full_name']; ?></td>
            <td><?= $cand['position_name']; ?></td>
            <td><?= $cand['partylist_name']; ?></td>
            <td>
                <a href="edit_candidate.php?id=<?= $cand['candidate_id']; ?>">Edit</a> |
                <a href="candidate_maintenance.php?delete=<?= $cand['candidate_id']; ?>" onclick="return confirm('Delete this candidate?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
