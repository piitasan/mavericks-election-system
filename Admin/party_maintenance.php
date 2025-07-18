<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$error = "";

if (isset($_POST['add'])) {
    $partylist_name = $_POST['partylist_name'];
    $stmt = $pdo->prepare("SELECT * FROM partylist_tbl WHERE partylist_name = :partylist_name AND deleted_at IS NULL");
    $stmt->execute(['partylist_name' => $partylist_name]);
    $existing_party = $stmt->fetch();

    if ($existing_party) {
        $error = "Party name already exists!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO partylist_tbl (partylist_name) VALUES (:partylist_name)");
        $stmt->execute(['partylist_name' => $partylist_name]);

        $action = "Added a New Partylist: $partylist_name";
        $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $action]);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    if ($id) {
        $stmt = $pdo->prepare("SELECT partylist_name FROM partylist_tbl WHERE partylist_id = :id");
        $stmt->execute(['id' => $id]);
        $partylist = $stmt->fetch();

        $stmt = $pdo->prepare("UPDATE partylist_tbl SET deleted_at = NOW() WHERE partylist_id = :id");
        $stmt->execute(['id' => $id]);

        $stmt = $pdo->prepare("DELETE FROM partylist_tbl WHERE partylist_id = :id");
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
    </div>

    <main class="content">
    <div class="forms-container <?= $edit_party ? 'split' : ''; ?>">

        <div class="form-section">
            <h2 class="center-title">Party Maintenance</h2>
            <form method="POST" class="party-form">
                <label>Party Name:</label>
                <?php if (!empty($error)): ?>
                    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
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
                        <a href="#" class="delete-party-btn" data-id="<?= $party['partylist_id']; ?>" data-name="<?= htmlspecialchars($party['partylist_name']) ?>">Delete</a>
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

<script src="admin_dashboard_script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-party-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const partyId = this.dataset.id;
            const partyName = this.dataset.name;

            fetch(`get_party_candidate_count.php?partylist_id=${partyId}`)
                .then(response => response.json())
                .then(data => {
                    const count = data.count;
                    const message = `There ${count === 1 ? 'is' : 'are'} ${count} candidate${count !== 1 ? 's' : ''} under the party "${partyName}".\n\nThe candidate/s will be also removed.\n\nThis action cannot be undone.\n\nAre you sure you want to delete it?`;

                    if (confirm(message)) {
                        window.location.href = `party_maintenance.php?delete=${partyId}`;
                    }
                })
                .catch(error => {
                    alert('Failed to fetch candidate count. Please try again.');
                    console.error(error);
                });
        });
    });
});
</script>

</body>
</html>
