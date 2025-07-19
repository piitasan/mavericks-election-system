<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniVote Portal</title>
    <link rel="stylesheet" href="portal_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div id="preloader">
    <div class="loader"></div>
    <p> Loading UniVote...</p>
    </div>

    <div class="container">
        <div class="left">
            <div class="typewriter">
                <h1 id="typewriter-text"></h1>
            </div>
        </div>

        <div class="right">
            <img src="assets/univote.png" alt="UniVote Logo" class="logo">
            <p class="tagline">Your University Voting Companion. Vote for Change.</p>

            <div class="login-content">
                <p class="prompt">PLEASE SELECT YOUR LOGIN PORTAL BELOW:</p>
                <div class="button-group">
                    <a class="btn" href="student/student_login.php"><i class="fa-solid fa-user-graduate"></i> Login as Student</a>
                    <a class="btn" href="admin/admin_login.php"><i class="fa-solid fa-user-shield"></i> Login as Admin</a>
                </div>
            </div>

            <footer>Driven by Maverick Studios &copy;2025</footer>
        </div>
    </div>
    <script src="portal_script.js"></script>
</body>
</html>
