<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

function getRecentRows($pdo, $sql) {
    return $pdo->query($sql)->fetchAll();
}

function getCount($pdo, $sql) {
    return $pdo->query($sql)->fetchColumn();
}

$new_students = getRecentRows($pdo, "
    SELECT student_id, created_at
    FROM user_tbl
    WHERE role = 'student'
    ORDER BY created_at DESC
    LIMIT 5
");

$new_votes = getRecentRows($pdo, "
    SELECT u.student_id, v.created_at
    FROM vote_tbl v
    JOIN user_tbl u ON v.user_id = u.user_id
    ORDER BY v.created_at DESC
    LIMIT 5
");

$new_partylists = getRecentRows($pdo, "
    SELECT partylist_name, created_at
    FROM partylist_tbl
    ORDER BY created_at DESC
    LIMIT 5
");

$deleted_partylists = getRecentRows($pdo, "
    SELECT partylist_name, deleted_at
    FROM partylist_tbl
    WHERE deleted_at IS NOT NULL
    ORDER BY deleted_at DESC
    LIMIT 5
");

$new_candidates = getRecentRows($pdo, "
    SELECT full_name, created_at
    FROM candidate_tbl
    ORDER BY created_at DESC
    LIMIT 5
");

$total_students = getCount($pdo, "SELECT COUNT(*) FROM user_tbl WHERE role = 'student'");
$total_candidates = getCount($pdo, "SELECT COUNT(*) FROM candidate_tbl");
$total_votes = getCount($pdo, "SELECT COUNT(*) FROM vote_tbl");
$total_partylists = getCount($pdo, "SELECT COUNT(*) FROM partylist_tbl WHERE deleted_at IS NULL");

$logs = getRecentRows($pdo, "
    SELECT action, created_at
    FROM system_logs
    ORDER BY created_at DESC
    LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard_style.css"/>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
            <div class="navbar-title">Admin Dashboard</div>
        </div>
        <div class="profile" onclick="toggleDropdown()">
            <div class="profile-texts">
                <span class="profile-name">Admin</span>
                <span class="profile-subtext">Maverick Studio</span>
            </div>
            <img src="https://images.unsplash.com/photo-1529778873920-4da4926a72c2?fm=jpg&q=60&w=3000" alt="Admin" class="profile-img" />
            <div class="dropdown-content" id="profileDropdown">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <ul>
            <li>
                <a href="party_maintenance.php">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/people-fill.svg" alt="Party Icon" />
                    <span>Party Maintenance</span>
                </a>
            </li>
            <li>
                <a href="position_maintenance.php">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/diagram-3-fill.svg" alt="Position Icon" />
                    <span>Position Maintenance</span>
                </a>
            </li>
            <li>
                <a href="candidate_maintenance.php">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/person-fill.svg" alt="Candidate Icon" />
                    <span>Candidate Maintenance</span>
                </a>
            </li>
            <li>
                <a href="voter_maintenance.php">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/check-circle-fill.svg" alt="Voter Icon" />
                    <span>Voter Maintenance</span>
                </a>
            </li>
            <li>
                <a href="election_report.php">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/file-earmark-bar-graph-fill.svg" alt="Reports Icon" />
                    <span>Election Report</span>
                </a>
            </li>
        </ul>
        <div class="clear-db-container">
            <form action="admin_clear_database.php" method="POST" onsubmit="return confirm('⚠️ Are you sure you want to clear the entire database? This action cannot be undone.')">
                <button type="submit" class="clear-db-button">
                    <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 456 511.82"><path fill="#FD3B3B" d="M48.42 140.13h361.99c17.36 0 29.82 9.78 28.08 28.17l-30.73 317.1c-1.23 13.36-8.99 26.42-25.3 26.42H76.34c-13.63-.73-23.74-9.75-25.09-24.14L20.79 168.99c-1.74-18.38 9.75-28.86 27.63-28.86zM24.49 38.15h136.47V28.1c0-15.94 10.2-28.1 27.02-28.1h81.28c17.3 0 27.65 11.77 27.65 28.01v10.14h138.66c.57 0 1.11.07 1.68.13 10.23.93 18.15 9.02 18.69 19.22.03.79.06 1.39.06 2.17v42.76c0 5.99-4.73 10.89-10.62 11.19-.54 0-1.09.03-1.63.03H11.22c-5.92 0-10.77-4.6-11.19-10.38 0-.72-.03-1.47-.03-2.23v-39.5c0-10.93 4.21-20.71 16.82-23.02 2.53-.45 5.09-.37 7.67-.37zm83.78 208.38c-.51-10.17 8.21-18.83 19.53-19.31 11.31-.49 20.94 7.4 21.45 17.57l8.7 160.62c.51 10.18-8.22 18.84-19.53 19.32-11.32.48-20.94-7.4-21.46-17.57l-8.69-160.63zm201.7-1.74c.51-10.17 10.14-18.06 21.45-17.57 11.32.48 20.04 9.14 19.53 19.31l-8.66 160.63c-.52 10.17-10.14 18.05-21.46 17.57-11.31-.48-20.04-9.14-19.53-19.32l8.67-160.62zm-102.94.87c0-10.23 9.23-18.53 20.58-18.53 11.34 0 20.58 8.3 20.58 18.53v160.63c0 10.23-9.24 18.53-20.58 18.53-11.35 0-20.58-8.3-20.58-18.53V245.66z"/></svg>
                    Clear Database
                </button>
            </form>
        </div>
    </div>

        <main class="content">
        <section class="notifications-section card">
        <h2>📢 Notifications</h2>

        <div class="notification-block">
            <h3>New Student Registrations</h3>
            <ul>
            <?php foreach ($new_students as $s): ?>
                <li><strong>ID:</strong> <?= htmlspecialchars($s['student_id']) ?> <span class="date"><?= $s['created_at'] ?></span></li>
            <?php endforeach; ?>
            </ul>
        </div>

        <div class="notification-block">
            <h3>Recent Votes</h3>
            <ul>
            <?php foreach ($new_votes as $v): ?>
                <li><strong>ID:</strong> <?= htmlspecialchars($v['student_id']) ?> <span class="date"><?= $v['created_at'] ?></span></li>
            <?php endforeach; ?>
            </ul>
        </div>

        <div class="notification-block">
            <h3>New Party Lists</h3>
            <ul>
            <?php foreach ($new_partylists as $p): ?>
                <li><?= htmlspecialchars($p['partylist_name']) ?> <span class="date"><?= $p['created_at'] ?></span></li>
            <?php endforeach; ?>
            </ul>
        </div>

        <div class="notification-block">
            <h3>Deleted Party Lists</h3>
            <ul>
            <?php if (count($deleted_partylists) > 0): ?>
                <?php foreach ($deleted_partylists as $dp): ?>
                <li><?= htmlspecialchars($dp['partylist_name']) ?> <span class="date">Deleted at <?= $dp['deleted_at'] ?></span></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No deleted party lists.</li>
            <?php endif; ?>
            </ul>
        </div>

        <div class="notification-block">
            <h3>New Candidates</h3>
            <ul>
            <?php foreach ($new_candidates as $c): ?>
                <li><?= htmlspecialchars($c['full_name']) ?> <span class="date"><?= $c['created_at'] ?></span></li>
            <?php endforeach; ?>
            </ul>
        </div>
        </section>

        <section class="summary-section card">
        <h2>📊 Summary</h2>
        <div class="summary-grid">
            <div class="summary-card">
            <h3>Total Students</h3>
            <p><?= $total_students ?></p>
            </div>
            <div class="summary-card">
            <h3>Total Candidates</h3>
            <p><?= $total_candidates ?></p>
            </div>
            <div class="summary-card">
            <h3>Total Votes</h3>
            <p><?= $total_votes ?></p>
            </div>
            <div class="summary-card">
            <h3>Active Party Lists</h3>
            <p><?= $total_partylists ?></p>
            </div>
        </div>
        </section>

        <section class="system-logs card">
        <h2>📝 System Logs</h2>
        <ul>
            <?php if (count($logs) > 0): ?>
            <?php foreach ($logs as $log): ?>
                <li><span class="date">[<?= $log['created_at'] ?>]</span> <?= htmlspecialchars($log['action']) ?></li>
            <?php endforeach; ?>
            <?php else: ?>
            <li>No recent activity logs.</li>
            <?php endif; ?>
        </ul>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Driven By Maverick Studio. All rights reserved.</p>
        <small>Version: <?= SYSTEM_VERSION ?></small>
    </footer>
    <script src="admin_dashboard_script.js"></script>
</body>
</html>
