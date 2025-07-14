<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['add'])) {
    $partylist_name = $_POST['partylist_name'];
    $stmt = $pdo->prepare("INSERT INTO partylist_tbl (partylist_name) VALUES (:partylist_name)");
    $stmt->execute(['partylist_name' => $partylist_name]);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($id) {
        $stmt = $pdo->prepare("UPDATE partylist_tbl SET deleted_at = NOW() WHERE partylist_id = :id");
        $stmt->execute(['id' => $id]);
    }
    header("Location: party_maintenance.php");
    exit;
}

$parties = $pdo->query("SELECT * FROM partylist_tbl WHERE deleted_at IS NULL")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Party Maintenance</title></head>
<body>
    <h2>Party Maintenance</h2>
    <form method="POST">
        <label>Party Name:</label>
        <input type="text" name="partylist_name" required>
        <button type="submit" name="add">Add Party</button>
    </form>

    <h3>Existing Partylists</h3>
    <table border="1">
        <tr>
            <th>Party ID</th>
            <th>Party Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($parties as $party): ?>
        <tr>
            <td><?= $party['partylist_id']; ?></td>
            <td><?= $party['partylist_name']; ?></td>
            <td>
                <a href="edit_party.php?id=<?= $party['partylist_id']; ?>">Edit</a> |
                <a href="party_maintenance.php?delete=<?= $party['partylist_id']; ?>" onclick="return confirm('Delete this party?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
