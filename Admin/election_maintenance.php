<?php

/* Prevents Browser Caching (Backtracking) */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once 'db_connect.php';
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
        $params = [
            ':start' => $start_date,
            ':end' => $end_date
        ];
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
            if ($election_id) {
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

$editing = false;
$edit_data = [];
if (isset($_GET['edit_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM election_tbl WHERE election_id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $editing = true;
}

$elections = $pdo->query("SELECT * FROM election_tbl ORDER BY start_date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Election Maintenance</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #f7f7f7; }
        table { border-collapse: collapse; width: 100%; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
        form { margin-top: 20px; background: #fff; padding: 20px; border: 1px solid #ccc; max-width: 500px; }
        input, button { padding: 8px; width: 100%; margin-bottom: 10px; }
        .message { color: green; }
        .error { color: red; }
        .action-btn { background: #0066cc; color: white; border: none; cursor: pointer; padding: 5px 10px; }
        .action-btn:hover { background: #004080; }
    </style>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>

    <h1>🗳️ Election Maintenance</h1>

    <a href="admin_dashboard.php" style="text-decoration: none;">
        <button style="padding: 10px 20px; background-color: #555; color: #fff; border: none; cursor: pointer; margin-top: 10px;">
            ⬅️ Back to Dashboard
        </button>
    </a>

    <?php if ($message): ?>
        <p class="message"><?= $message ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <h2><?= $editing ? "✏️ Edit Election" : "➕ Add New Election" ?></h2>

        <input type="hidden" name="election_id" value="<?= $editing ? $edit_data['election_id'] : '' ?>">

        <label>Election Name:</label>
        <input type="text" name="election_name" required value="<?= $editing ? htmlspecialchars($edit_data['election_name']) : '' ?>">

        <label>Start Date:</label>
        <input type="date" name="start_date" required value="<?= $editing ? $edit_data['start_date'] : '' ?>">

        <label>End Date:</label>
        <input type="date" name="end_date" required value="<?= $editing ? $edit_data['end_date'] : '' ?>">

        <button type="submit"><?= $editing ? "Update Election" : "Add Election" ?></button>
        <?php if ($editing): ?>
            <a href="election_maintenance.php" style="margin-left: 10px;">Cancel</a>
        <?php endif; ?>
    </form>

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

</body>
</html>