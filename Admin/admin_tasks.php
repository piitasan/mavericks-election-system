<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['add_task'])) {
    $desc = trim($_POST['task_desc']);
    if ($desc != '') {
        $stmt = $pdo->prepare("INSERT INTO user_tasks (admin_id, description) VALUES (?, ?)");
        $stmt->execute([$admin_id, $desc]);
    }
    header("Location: admin_dashboard.php");
    exit;
}

if (isset($_POST['toggle_task'])) {
    $task_id = $_POST['task_id'];
    $stmt = $pdo->prepare("UPDATE user_tasks SET is_done = NOT is_done WHERE task_id = ? AND admin_id = ?");
    $stmt->execute([$task_id, $admin_id]);
    exit;
}

if (isset($_POST['delete_task'])) {
    $task_id = $_POST['task_id'];
    $stmt = $pdo->prepare("DELETE FROM user_tasks WHERE task_id = ? AND admin_id = ?");
    $stmt->execute([$task_id, $admin_id]);
    exit;
}
?>
