<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    die("Unauthorized access.");
}

try {
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

    $pdo->exec("TRUNCATE TABLE vote_tbl");
    $pdo->exec("TRUNCATE TABLE candidate_tbl");
    $pdo->exec("TRUNCATE TABLE partylist_tbl");

    $pdo->exec("DELETE FROM user_tbl WHERE role = 'student'");

    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    echo "✅ Database cleared successfully. Admin account remains intact.<br><br>";

    echo '<a href="admin_login.php">Go back to Admin Login</a>';

} catch (PDOException $e) {
    echo "❌ Error clearing database: " . $e->getMessage();
    echo '<br><a href="admin_login.php">Go back to Admin Login</a>';
}
?>
