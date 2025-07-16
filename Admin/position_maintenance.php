<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['add_position'])) {
    $position_name = $_POST['position_name'];
    $stmt = $pdo->prepare("INSERT INTO position_tbl (position_name) VALUES (:position_name)");
    $stmt->execute(['position_name' => $position_name]);

    $action = "Added a New Position: $position_name";
    $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
    $stmt->execute([$_SESSION['admin_id'], $action]);

    header("Location: position_maintenance.php");
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM position_tbl WHERE position_id = :pid");
    $stmt->execute(['pid' => $_GET['delete']]);
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456 511.82"><path fill="#FD3B3B" d="..."/></svg>
                Clear Database
            </button>
        </form>
    </div>
</div>

<main class="content">
    <div class="forms-container <?= $edit_candidate ? 'split' : ''; ?>">
        <div class="form-section">
            <h2 class="center-title">Add Position</h2>
            <form method="POST" class="position-form">
                <label>Position Name:</label>
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