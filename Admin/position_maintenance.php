<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$error = "";

if (isset($_POST['add_position'])) {
    $position_name = $_POST['position_name'];

    $stmt = $pdo->prepare("SELECT * FROM position_tbl WHERE position_name = :position_name");
    $stmt->execute(['position_name' => $position_name]);
    $existing_position = $stmt->fetch();

    if ($existing_position) {
        $error = "Position name already exists!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO position_tbl (position_name) VALUES (:position_name)");
        $stmt->execute(['position_name' => $position_name]);

        $action = "Added a New Position: $position_name";
        $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $action]);

        header("Location: position_maintenance.php");
        exit;
    }
}

if (isset($_GET['delete'])) {
    $position_id = $_GET['delete'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM candidate_tbl WHERE position_id = :pid");
    $stmt->execute(['pid' => $position_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $_SESSION['error'] = "Cannot delete position. There are candidates assigned to it.";
    } else {
        $stmt = $pdo->prepare("DELETE FROM position_tbl WHERE position_id = :pid");
        $stmt->execute(['pid' => $position_id]);

        $action = "Deleted Position ID: $position_id";
        $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $action]);
    }

    header("Location: position_maintenance.php");
    exit;
}

$edit_candidate = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM position_tbl WHERE position_id = :id");
    $stmt->execute(['id' => $id]);
    $edit_candidate = $stmt->fetch();
}

if (isset($_POST['update']) && isset($_POST['position_id'])) {
    $position_id = $_POST['position_id'];
    $position_name = $_POST['position_name'];
    $stmt = $pdo->prepare("UPDATE position_tbl SET position_name = :position_name WHERE position_id = :id");
    $stmt->execute([
        'position_name' => $position_name,
        'id' => $position_id
    ]);
}

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Position Maintenance</title>
    <link rel="stylesheet" href="position_maintenance.css"/>
</head>
<body>
<nav class="navbar">
    <div class="nav-left">
        <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
        <span class="navbar-title">Position Maintenance</span>
    </div>
    <div class="navbar-right">
        <a href="admin_dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
    </div>
</nav>

<div class="sidebar">
        <ul>
            <li>
                <a href="election_maintenance.php">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/calendar-event-fill.svg" alt="Election Icon" />
                    <span>Election Maintenance</span>
                </a>
            </li>
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
    <?php if (isset($_SESSION['error'])): ?>
    <div style="color: red; text-align: center; margin-bottom: 10px;">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>

    <div class="forms-container <?= $edit_candidate ? 'split' : ''; ?>">
        <div class="form-section">
            <h2 class="center-title">Add New Position</h2>
            <form method="POST" class="position-form">
                <label>Position Name:</label>
                <?php if (!empty($error)): ?>
                    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <input type="text" name="position_name" required>
                <button type="submit" name="add_position">Add Position</button>
            </form>
        </div>

        <?php if ($edit_candidate): ?>
        <div class="form-section edit">
            <form method="POST" class="position-form">
                <h2 class="center-title">Edit Position</h2>
                <input type="hidden" name="position_id" value="<?= $edit_candidate['position_id']; ?>">
                <label>Position Name:</label>
                <input type="text" name="position_name"
                       value="<?= isset($_POST['position_name']) && isset($_POST['update']) ? htmlspecialchars($_POST['position_name']) : htmlspecialchars($edit_candidate['position_name']); ?>"
                       required>
                <button type="submit" name="update">Update Position</button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <div class="content-table">
        <h2 class="left-title">Existing Positions</h2>
        <table>
            <tr><th>ID</th><th>Position Name</th><th>Action</th></tr>
            <?php foreach ($positions as $p): ?>
            <tr>
                <td><?= $p['position_id']; ?></td>
                <td><?= $p['position_name']; ?></td>
                <td>
                    <a href="position_maintenance.php?edit=<?= $p['position_id']; ?>">Edit</a> |
                    <a href="position_maintenance.php?delete=<?= $p['position_id']; ?>" onclick="return confirm('Delete this position?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>

<footer class="footer">
    <p>&copy; <?= date('Y') ?> Driven By Maverick Studio. All rights reserved.</p>
    <small>Version: <?= SYSTEM_VERSION ?></small>
</footer>
<script src="admin_dashboard_script.js"></script>
</body>
</html>
