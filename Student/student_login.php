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
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="student_style.css">
</head>
<body>
    <div class="login-container">
        <h2>Student Login</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" id="student_id" value="<?= htmlspecialchars($student_id); ?>">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <button type="submit" name="login">Login</button>
        </form>
        <div class="links">
            <a href="student_registration.php">Register Here</a> |
            <a href="../mavericks_portal.php">Go Back</a>
        </div>
    </div>
</body>
</html>
