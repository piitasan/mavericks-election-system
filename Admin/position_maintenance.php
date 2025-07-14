<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['add_position'])) {
    $position_name = $_POST['position_name'];
    $stmt = $pdo->prepare("INSERT INTO position_tbl (position_name) VALUES (:position_name)");
    $stmt->execute(['position_name' => $position_name]);
    header("Location: position_maintenance.php");
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM position_tbl WHERE position_id = :pid");
    $stmt->execute(['pid' => $_GET['delete']]);
    header("Location: position_maintenance.php");
    exit;
}

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Position Maintenance</title></head>
<body>
    <h2>Position Maintenance</h2>

    <form method="POST">
        Position Name: <input type="text" name="position_name" required>
        <button type="submit" name="add_position">Add Position</button>
    </form>

    <h3>Existing Positions</h3>
    <table border="1">
        <tr><th>ID</th><th>Position Name</th><th>Action</th></tr>
        <?php foreach ($positions as $p): ?>
        <tr>
            <td><?= $p['position_id']; ?></td>
            <td><?= $p['position_name']; ?></td>
            <td>
                <a href="edit_position.php?id=<?= $p['position_id']; ?>">Edit</a> |
                <a href="position_maintenance.php?delete=<?= $p['position_id']; ?>" onclick="return confirm('Delete this position?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br><a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
