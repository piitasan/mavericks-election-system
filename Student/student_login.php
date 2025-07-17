<?php
session_start();
require 'db_connect.php';

$student_id = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = htmlspecialchars(trim($_POST['student_id']));
    $password = htmlspecialchars($_POST['password']);

    if (empty($student_id) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user_tbl WHERE student_id = :student_id");
        $stmt->execute(['student_id' => $student_id]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['student_id'] = $user['student_id'];
            header("Location: student_dashboard.php");
            exit;
        } else {
            $error = "Invalid student ID or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="student_login_style.css">
</head>
<body>
<form method="POST">
    <h2>Student Login</h2>
    <?php if (!empty($error)) echo '<div class="error">' . htmlspecialchars($error) . '</div>'; ?>
    <div class="inputBox">
        <input type="text" name="student_id" id="student_id" required placeholder=" " value="<?= htmlspecialchars($student_id); ?>">
        <label for="student_id">Student ID</label>
    </div>
    <div class="inputBox">
        <input type="password" name="password" id="password" required placeholder=" ">
        <label for="password">Password</label>
    </div>
    <button type="submit" name="login">🔐 Login</button>
    <div class="links">
        <a href="student_registration.php">Register Here</a> |
        <a href="../mavericks_portal.php">Go Back</a>
    </div>
</form>
</body>
</html>