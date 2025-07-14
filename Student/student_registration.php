<?php
require 'db_connect.php';

if (isset($_POST['register'])) {
    $student_id = trim($_POST['student_id']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = trim($_POST['first_name']);
    $middle_initial = trim($_POST['middle_initial']);
    $last_name = trim($_POST['last_name']);
    $suffix = trim($_POST['suffix']);
    $course = trim($_POST['course']);
    $year_level = trim($_POST['year_level']);
    $section = trim($_POST['section']);

    if (!preg_match('/^2025\d{5}$/', $student_id)) {
    echo "❌ Student ID must start with 2025 and be followed by 5 digits.";
    } elseif ($password !== $confirm_password) {
        echo "❌ Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO user_tbl
        (student_id, password, first_name, middle_initial, last_name, suffix, section, course, year_level, role)
        VALUES
        (:student_id, :password, :first_name, :middle_initial, :last_name, :suffix, :section, :course, :year_level, 'student')");
        $stmt->execute([
            'student_id' => $student_id,
            'password' => $hashed_password,
            'first_name' => $first_name,
            'middle_initial' => $middle_initial,
            'last_name' => $last_name,
            'suffix' => $suffix,
            'section' => $section,
            'course' => $course,
            'year_level' => $year_level
        ]);

        echo "✅ Registered successfully. <a href='student_login.php'>Login here</a>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Student Registration</title></head>
<body>
    <h2>Student Registration</h2>
    <form method="POST">
        <label>Student ID:</label>
        <input type="text" name="student_id" placeholder="e.g. 202512345" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>

        <label>First Name:</label>
        <input type="text" name="first_name" required><br>

        <label>Middle Initial:</label>
        <input type="text" name="middle_initial" maxlength="1"><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label>Suffix:</label>
        <input type="text" name="suffix" placeholder="e.g. Jr, Sr"><br>

        <label>Course:</label>
        <input type="text" name="course" placeholder="e.g. BSIT" required><br>

        <label>Year Level:</label>
        <select name="year_level" required>
            <option value="">Select</option>
            <option value="1">1st Year</option>
            <option value="2">2nd Year</option>
            <option value="3">3rd Year</option>
            <option value="4">4th Year</option>
        </select><br>

        <label>Section:</label>
        <input type="text" name="section" placeholder="e.g. TX21" required><br>

        <button type="submit" name="register">Register</button>
    </form>
    <br><a href="student_login.php">Back to Login</a>
</body>
</html>
