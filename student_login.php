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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Login</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Verdana&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Verdana', 'Geneva', 'Tahoma', sans-serif;
}
:root {
    --primary-color: #1E40AF;
    --primary-dark: #1E3A8A;
    --background-color: whitesmoke;
}
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: var(--background-color);
}
form {
    background-color: white;
    padding: 40px 60px;
    text-align: center;
    display: flex;
    flex-direction: column;
    border-radius: 16px;
    box-shadow: 0 0 12px rgba(30, 64, 175, 0.2);
    width: 320px;
}
form h2 {
    color: var(--primary-color);
    font-weight: 500;
    text-transform: uppercase;
    font-size: 1.5em;
    letter-spacing: .1em;
    margin-bottom: 30px;
}
.inputBox {
    position: relative;
    margin-bottom: 30px;
}
.inputBox input {
    width: 100%;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 8px;
    outline: none;
    font-size: 1em;
    background: transparent;
}
.inputBox label {
    position: absolute;
    top: 10px;
    left: 15px;
    pointer-events: none;
    color: #999;
    transition: 0.3s ease-in-out;
    background: white;
    padding: 0 5px;
}
.inputBox input:focus ~ label,
.inputBox input:not(:placeholder-shown) ~ label {
    top: -10px;
    left: 10px;
    color: var(--primary-color);
    font-size: 0.85em;
}
.inputBox input:focus,
.inputBox input:valid {
    border-color: var(--primary-color);
}
button[type="submit"] {
    background: var(--primary-color);
    border: none;
    padding: 12px;
    border-radius: 8px;
    color: white;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}
button[type="submit"]:hover {
    background: var(--primary-dark);
}
.error {
    color: red;
    margin-bottom: 15px;
    font-size: 0.9em;
}
.links {
    margin-top: 20px;
    font-size: 0.9em;
}
.links a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    margin: 0 5px;
}
</style>
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
    <button type="submit" name="login">Login</button>
    <div class="links">
        <a href="student_registration.php">Register Here</a> |
        <a href="../mavericks_portal.php">Go Back</a>
    </div>
</form>
</body>
</html>
