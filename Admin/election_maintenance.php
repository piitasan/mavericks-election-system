<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once 'db_connect.php';
require_once 'version.php';

$error = '';
$message = '';

$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';
if ($status === 'success') {
    $message = "✅ Election saved successfully.";
} elseif ($status === 'error') {
    if ($msg === 'overlap') {
        $error = "⚠️ Overlapping with another election. Please choose different dates.";
    } else {
        $error = "⚠️ Error occurred. Please try again.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $election_id = $_POST['election_id'] ?? null;
    $election_name = trim($_POST['election_name']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if (!empty($election_name) && $start_date && $end_date && $start_date < $end_date) {
        $query = "
            SELECT * FROM election_tbl
            WHERE NOT (end_date < :start OR start_date > :end)
        ";
        $params = [':start' => $start_date, ':end' => $end_date];

        if ($election_id) {
            $query .= " AND election_id != :id";
            $params[':id'] = $election_id;
        }

        $check = $pdo->prepare($query);
        $check->execute($params);

        if ($check->rowCount() > 0) {
            header("Location: election_maintenance.php?status=error&msg=overlap");
            exit;
        } else {
            if (isset($_POST['update'])) {
                $stmt = $pdo->prepare("UPDATE election_tbl SET election_name = ?, start_date = ?, end_date = ? WHERE election_id = ?");
                $stmt->execute([$election_name, $start_date, $end_date, $election_id]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO election_tbl (election_name, start_date, end_date) VALUES (?, ?, ?)");
                $stmt->execute([$election_name, $start_date, $end_date]);
            }
            header("Location: election_maintenance.php?status=success");
            exit;
        }
    } else {
        header("Location: election_maintenance.php?status=error&msg=invalid");
        exit;
    }
}

$edit_election = null;
if (isset($_GET['edit_id'])) {
    $election_id = $_GET['edit_id'];
    $stmt = $pdo->prepare("SELECT * FROM election_tbl WHERE election_id = ?");
    $stmt->execute([$election_id]);
    $edit_election = $stmt->fetch(PDO::FETCH_ASSOC);
}

$elections = $pdo->query("SELECT * FROM election_tbl ORDER BY start_date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Election Maintenance</title>
    <link rel="stylesheet" href="election_maintenance.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
            <span class="navbar-title">Election Maintenance</span>
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

    <?php if ($message): ?>
        <p class="message"><?= $message ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <main class="content">
        <div class="forms-container <?= $edit_election ? 'split' : ''; ?>">
            <div class="form-section">
                <h2 class="center-title">Add New Election</h2>
                <form method="POST" class="election-form">
                    <label>Election Name:</label>
                    <input type="text" name="election_name" required value="<?= htmlspecialchars($election_name ?? '') ?>">

                    <label>Start Date:</label>
                    <input type="date" name="start_date" required value="<?= htmlspecialchars($start_date ?? '') ?>">

                    <label>End Date:</label>
                    <input type="date" name="end_date" required value="<?= htmlspecialchars($end_date ?? '') ?>">

                    <button type="submit" name="add">Add Election</button>
                </form>
            </div>

            <?php if ($edit_election): ?>
            <div class="form-section edit">
                <h2 class="center-title">Edit Election</h2>
                <form method="POST" class="election-form">
                    <input type="hidden" name="election_id" value="<?= $edit_election['election_id'] ?>">

                    <label>Election Name:</label>
                    <input type="text" name="election_name" required value="<?= htmlspecialchars($edit_election['election_name']) ?>">

                    <label>Start Date:</label>
                    <input type="date" name="start_date" required value="<?= $edit_election['start_date'] ?>">

                    <label>End Date:</label>
                    <input type="date" name="end_date" required value="<?= $edit_election['end_date'] ?>">

                    <button type="submit" name="update">Update Election</button>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <div class="content-table">
            <h2 class="left-title">Existing Elections</h2>
            <table>
                <thead>
                    <tr>
                        <th>Election Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($elections as $e): ?>
                        <?php
                            $now = date('Y-m-d');
                            if ($e['start_date'] <= $now && $e['end_date'] >= $now) {
                                $status = "<span style='color: green;'>Active</span>";
                            } elseif ($e['start_date'] > $now) {
                                $status = "<span style='color: orange;'>Upcoming</span>";
                            } else {
                                $status = "<span style='color: red;'>Ended</span>";
                            }
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($e['election_name']) ?></td>
                            <td><?= $e['start_date'] ?></td>
                            <td><?= $e['end_date'] ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <form method="GET" style="display:inline;">
                                    <input type="hidden" name="edit_id" value="<?= $e['election_id'] ?>">
                                    <button class="action-btn" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
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
