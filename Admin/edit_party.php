<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $partylist_name = $_POST['partylist_name'];
    $stmt = $pdo->prepare("UPDATE partylist_tbl SET partylist_name = :partylist_name WHERE partylist_id = :id");
    $stmt->execute(['partylist_name' => $partylist_name, 'id' => $id]);
    header("Location: party_maintenance.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM partylist_tbl WHERE partylist_id = :id");
$stmt->execute(['id' => $id]);
$party = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Party</title></head>
<body>
    <h2>Edit Party</h2>
    <form method="POST">
        <label>Party Name:</label>
        <input type="text" name="partylist_name" value="<?= $party['partylist_name']; ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <br><a href="party_maintenance.php">Back</a>
</body>
</html>
