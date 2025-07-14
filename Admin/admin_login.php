<?php
session_start();
require 'db_connect.php';

$username = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user_tbl WHERE username = :username AND role = 'admin'");
        $stmt->execute(['username' => $username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['user_id'];

            $action = "Logged In";
            $stmtLog = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
            $stmtLog->execute([$_SESSION['admin_id'], $action]);

            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid admin credentials.";
            // echo password_hash("admin123", PASSWORD_DEFAULT);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username); ?>">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <button type="submit" name="login">Login</button>
        </form>
        <div class="links">
            <a href="../mavericks_portal.php">Go Back</a>
        </div>
    </div>
</body>
</html>