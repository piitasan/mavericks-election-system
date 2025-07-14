<?php
session_start();
require 'db_connect.php';

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    $admin_name = $_SESSION['admin_name'] ?? 'Admin';

    $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
    $stmt->execute([$admin_id, "$admin_name logged out"]);
}

session_destroy();
header("Location: admin_login.php");
exit;
?>
