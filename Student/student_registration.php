<?php
require 'db_connect.php';

$message = '';
$redirect = false;

// Generate the next valid student ID
$stmt = $pdo->query("SELECT MAX(CAST(SUBSTRING(student_id, 5, 5) AS UNSIGNED)) AS max_suffix FROM user_tbl WHERE student_id REGEXP '^2025[0-9]{5}$'");
$result = $stmt->fetch();
$max_suffix = $result && $result['max_suffix'] !== null ? (int)$result['max_suffix'] : -1;
$next_suffix = str_pad($max_suffix + 1, 5, '0', STR_PAD_LEFT);
$generated_student_id = '2025' . $next_suffix;

if (isset($_POST['register'])) {
    $student_id = $generated_student_id;
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = trim($_POST['first_name']);
    $middle_initial = trim($_POST['middle_initial']);
    $last_name = trim($_POST['last_name']);
    $suffix = trim($_POST['suffix']);
    $course = trim($_POST['course']);
    $year_level = trim($_POST['year_level']);
    $section = trim($_POST['section']);

    if ($password !== $confirm_password) {
        $message = '<div class="error">❌ Passwords do not match.</div>';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO user_tbl
        (student_id, password, first_name, middle_initial, last_name, suffix, section, course, year_level, role)
        VALUES
        (:student_id, :password, :first_name, :middle_initial, :last_name, :suffix, :section, :course, :year_level, 'student')");
        $success = $stmt->execute([
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

        if ($success) {
            $message = '<div class="success">✅ Registered successfully. Redirecting...</div>';
            $redirect = true;
        } else {
            $message = '<div class="error">❌ Registration failed, please try again.</div>';
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register to Univote</title>
    <link rel="stylesheet" href="student_registration_style.css">
</head>
<body>
    <div id="preloader">
    <div class="loader"></div>
    <p>Loading UniVote...</p>
    </div>
    <div class="left-side">
        <h2>Student Registration</h2>
    <?php if ($message) echo $message; ?>
</div>
    </div>
    <div class="right-side">
        <form method="POST">

            <div class="inputBox">
                <input type="text" name="student_id" value="<?= htmlspecialchars($generated_student_id); ?>" readonly>
                <label>Student ID (Auto-generated)</label>
            </div>

            <div class="inputBox">
                <input type="password" name="password" required placeholder=" ">
                <label>Password</label>
            </div>

            <div class="inputBox">
                <input type="password" name="confirm_password" required placeholder=" ">
                <label>Confirm Password</label>
            </div>

            <div class="inputBox">
                <input type="text" name="first_name" required placeholder=" ">
                <label>First Name</label>
            </div>

            <div class="inputBox">
                <input type="text" name="middle_initial" maxlength="1" placeholder=" ">
                <label>Middle Initial</label>
            </div>

            <div class="inputBox">
                <input type="text" name="last_name" required placeholder=" ">
                <label>Last Name</label>
            </div>

            <div class="inputBox">
                <input type="text" name="suffix" placeholder=" ">
                <label>Suffix (e.g. Jr, Sr)</label>
            </div>

            <div class="inputBox">
                <input type="text" name="course" required placeholder=" ">
                <label>Course (e.g. BSIT)</label>
            </div>

            <div class="inputBox">
                <select name="year_level" required>
                    <option value="" disabled selected hidden></option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
                <label>Year Level</label>
            </div>

            <div class="inputBox">
                <input type="text" name="section" required placeholder=" ">
                <label>Section (e.g. TX21)</label>
            </div>

            <button type="submit" name="register">Register</button>
        </form>

        <div class="links">
            <a href="student_login.php">Back to Login</a>
        </div>
    </div>

<?php if ($redirect): ?>
    <script>
    setTimeout(() => {
        window.location.href = 'student_login.php';
    }, 5000);
    </script>
<?php endif; ?>
<script>
    window.addEventListener("load", () => {
    document.getElementById("preloader").style.display = "none";
});
</script>
</body>

</html>
