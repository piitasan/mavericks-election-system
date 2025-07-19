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

            $action = "Admin logged in";
            $stmtLog = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
            $stmtLog->execute([$_SESSION['admin_id'], $action]);

            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid admin credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>UniVote Authorized Personnel</title>
    <link rel="stylesheet" href="admin_style.css?v=<?= time(); ?>">
    <style>
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="preloader">
    <div class="loader"></div>
    <p>Loading UniVote...</p>
    </div>

    <form method="POST">
        <h2>Admin Login</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="inputBox">
            <input type="text" name="username" id="username" placeholder= " " value="<?= htmlspecialchars($username); ?>">
            <label for="username">Admin Username</label>
        </div>
        <div class="inputBox">
            <input type="password" name="password" id="password" placeholder=" ">
            <label for="password">Admin Password</label>
        </div>
        <button type="submit" name="login">🔐 Login</button>
        <div class="links">
            <a href="../univote_portal.php">UniVote Portal</a>
        </div>
    </form>
<script>
    window.addEventListener("load", () => {
    document.getElementById("preloader").style.display = "none";
});
</script>
</body>
</html>