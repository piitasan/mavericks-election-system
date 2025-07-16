<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_POST['add'])) {
    $partylist_name = $_POST['partylist_name'];

    $stmt = $pdo->prepare("INSERT INTO partylist_tbl (partylist_name) VALUES (:partylist_name)");
    $stmt->execute(['partylist_name' => $partylist_name]);

    $action = "Added a New Partylist: $partylist_name";
    $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
    $stmt->execute([$_SESSION['admin_id'], $action]);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    if ($id) {
        $stmt = $pdo->prepare("SELECT partylist_name FROM partylist_tbl WHERE partylist_id = :id");
        $stmt->execute(['id' => $id]);
        $partylist = $stmt->fetch();

        $stmt = $pdo->prepare("UPDATE partylist_tbl SET deleted_at = NOW() WHERE partylist_id = :id");
        $stmt->execute(['id' => $id]);

        if ($partylist) {
            $action = "Deleted Partylist: " . $partylist['partylist_name'];
            $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
            $stmt->execute([$_SESSION['admin_id'], $action]);
        }
    }

    header("Location: party_maintenance.php");
    exit;
}

$edit_party = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM partylist_tbl WHERE partylist_id = :id");
    $stmt->execute(['id' => $id]);
    $edit_party = $stmt->fetch();
}

if (isset($_POST['update']) && isset($_POST['partylist_id'])) {
    $party_id = $_POST['partylist_id'];
    $party_name = $_POST['partylist_name'];
    $stmt = $pdo->prepare("UPDATE partylist_tbl SET partylist_name = :party_name WHERE partylist_id = :id");
    $stmt->execute([
        'party_name' => $party_name,
        'id' => $party_id
    ]);
}

$stmt = $pdo->query("SELECT partylist_id, partylist_name FROM partylist_tbl WHERE deleted_at IS NULL ORDER BY partylist_id ASC");
$parties = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Party Maintenance</title>
    <link rel="stylesheet" href="party_maintenance.css"/>
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
            <span class="navbar-title">Party Maintenance</span>
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
                    <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 456 511.82"><path fill="#FD3B3B" d="M48.42 140.13h361.99c17.36 0 29.82 9.78 28.08 28.17l-30.73 317.1c-1.23 13.36-8.99 26.42-25.3 26.42H76.34c-13.63-.73-23.74-9.75-25.09-24.14L20.79 168.99c-1.74-18.38 9.75-28.86 27.63-28.86zM24.49 38.15h136.47V28.1c0-15.94 10.2-28.1 27.02-28.1h81.28c17.3 0 27.65 11.77 27.65 28.01v10.14h138.66c.57 0 1.11.07 1.68.13 10.23.93 18.15 9.02 18.69 19.22.03.79.06 1.39.06 2.17v42.76c0 5.99-4.73 10.89-10.62 11.19-.54 0-1.09.03-1.63.03H11.22c-5.92 0-10.77-4.6-11.19-10.38 0-.72-.03-1.47-.03-2.23v-39.5c0-10.93 4.21-20.71 16.82-23.02 2.53-.45 5.09-.37 7.67-.37zm83.78 208.38c-.51-10.17 8.21-18.83 19.53-19.31 11.31-.49 20.94 7.4 21.45 17.57l8.7 160.62c.51 10.18-8.22 18.84-19.53 19.32-11.32.48-20.94-7.4-21.46-17.57l-8.69-160.63zm201.7-1.74c.51-10.17 10.14-18.06 21.45-17.57 11.32.48 20.04 9.14 19.53 19.31l-8.66 160.63c-.52 10.17-10.14 18.05-21.46 17.57-11.31-.48-20.04-9.14-19.53-19.32l8.67-160.62zm-102.94.87c0-10.23 9.23-18.53 20.58-18.53 11.34 0 20.58 8.3 20.58 18.53v160.63c0 10.23-9.24 18.53-20.58 18.53-11.35 0-20.58-8.3-20.58-18.53V245.66z"/></svg>
                    Clear Database
                </button>
            </form>
        </div>
    </div>


    <main class="content">
    <div class="forms-container <?= $edit_party ? 'split' : ''; ?>">

        <div class="form-section">
            <h2 class="center-title">Party Maintenance</h2>
            <form method="POST" class="party-form">
                <label>Party Name:</label>
                <input type="text" name="partylist_name" required>
                <button type="submit" name="add">Add Party</button>
            </form>
        </div>

        <?php if ($edit_party): ?>
        <div class="form-section edit">
            <form method="POST" class="party-form">
                <h2 class="center-title">Edit Party</h2>
                <input type="hidden" name="partylist_id" value="<?= $edit_party['partylist_id']; ?>">
                <label>Party Name:</label>
                <input type="text" name="partylist_name"
                       value="<?= isset($_POST['partylist_name']) && isset($_POST['update']) ? htmlspecialchars($_POST['partylist_name']) : htmlspecialchars($edit_party['partylist_name']); ?>"
                       required>
                <button type="submit" name="update">Update Party</button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <div class="content-table">
        <h2 class="left-title">Existing Partylists</h2>
        <table>
            <tr>
                <th>Party ID</th>
                <th>Party Name</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($parties)): ?>
                <?php foreach ($parties as $party): ?>
                <tr>
                    <td><?= $party['partylist_id']; ?></td>
                    <td><?= $party['partylist_name']; ?></td>
                    <td>
                        <a href="party_maintenance.php?edit=<?= $party['partylist_id']; ?>">Edit</a> |
                        <a href="party_maintenance.php?delete=<?= $party['partylist_id']; ?>" onclick="return confirm('Delete this party?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">No partylists found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</main>
    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Driven By Maverick Studio. All rights reserved.</p>
        <small>Version: <?= SYSTEM_VERSION ?></small>
    </footer>
</div>
</body>
</html>
