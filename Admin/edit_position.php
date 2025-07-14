<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: position_maintenance.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM position_tbl WHERE position_id = :pid");
$stmt->execute(['pid' => $_GET['id']]);
$position = $stmt->fetch();

if (!$position) {
    header("Location: position.php");
    exit;
}

if (isset($_POST['update_position'])) {
    $position_name = $_POST['position_name'];
    $stmt = $pdo->prepare("UPDATE position_tbl SET position_name = :position_name WHERE position_id = :pid");
    $stmt->execute([
        'position_name' => $position_name,
        'pid' => $_GET['id']
    ]);
    header("Location: position.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Position</title></head>
<body>
    <h2>Edit Position</h2>

    <form method="POST">
        Position Name: <input type="text" name="position_name" value="<?= $position['position_name']; ?>" required>
        <button type="submit" name="update_position">Update</button>
    </form>

    <br><a href="position_maintenance.php">Back to Position Maintenance</a>
</body>
</html>
