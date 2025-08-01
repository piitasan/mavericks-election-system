<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$errors_Add = [];
$errors_Update = [];

if (isset($_POST['add'])) {
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $position_id = isset($_POST['position_id']) ? trim($_POST['position_id']) : '';
    $partylist_id = isset($_POST['partylist_id']) ? trim($_POST['partylist_id']) : '';
    $election_id = isset($_POST['election_id']) ? trim($_POST['election_id']) : '';

    if (empty($full_name)) {
        $errors_Add['full_name'] = "Full Name is required.";
    }
    if (empty($position_id)) {
        $errors_Add['position_id'] = "Position is required.";
    }
    if (empty($partylist_id)) {
        $errors_Add['partylist_id'] = "Partylist is required.";
    }
    if (empty($election_id)) {
        $errors_Add['election_id'] = "Election is required.";
    }

    $image_name = null;
    if (isset($_FILES['candidate_image']) && $_FILES['candidate_image']['error'] == 0) {
        $target_dir = "dbImgUploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $temp = explode(".", $_FILES["candidate_image"]["name"]);
        $newfilename = uniqid('cand_', true) . '.' . end($temp);
        $target_file = $target_dir . $newfilename;

        move_uploaded_file($_FILES["candidate_image"]["tmp_name"], $target_file);

        $image_name = $newfilename;
    }


    if (empty($errors_Add)) {
        if (is_null($image_name) || $image_name === '') {
            $image_name = 'default_candidate_image.jpg';
        }
        $stmt = $pdo->prepare("INSERT INTO candidate_tbl (full_name, position_id, partylist_id, election_id, candidate_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $position_id, $partylist_id, $election_id, $image_name]);

        $action = "Added a New Candidate: $full_name";
        $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $action]);

        addNotification($pdo, 'candidate_add', 'Added candidate: ' . $full_name);
        $_SESSION['success_message'] = 'Candidate successfully added!';
        header("Location: candidate_maintenance.php");
        exit;
    }
}

if (isset($_POST['update'])) {
    $candidate_id = isset($_POST['candidate_id']) ? trim($_POST['candidate_id']) : '';
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $position_id = isset($_POST['position_id']) ? trim($_POST['position_id']) : '';
    $partylist_id = isset($_POST['partylist_id']) ? trim($_POST['partylist_id']) : '';
    $election_id = isset($_POST['election_id']) ? trim($_POST['election_id']) : '';

    if (empty($full_name)) {
        $errors_Update['full_name'] = "Full Name is required.";
    }
    if (empty($position_id)) {
        $errors_Update['position_id'] = "Position is required.";
    }
    if (empty($partylist_id)) {
        $errors_Update['partylist_id'] = "Partylist is required.";
    }
    if (empty($election_id)) {
        $errors_Update['election_id'] = "Election is required.";
    }

    $stmt = $pdo->prepare("SELECT candidate_image FROM candidate_tbl WHERE candidate_id = ?");
    $stmt->execute([$candidate_id]);
    $existing_candidate = $stmt->fetch();
    $image_name = $existing_candidate['candidate_image'];

    if (isset($_FILES['candidate_image']) && $_FILES['candidate_image']['error'] == 0) {
        if ($image_name != 'default_candidate_image.jpg' && file_exists("dbImgUploads/" . $image_name)) {
            unlink("dbImgUploads/" . $image_name);
        }

        $target_dir = "dbImgUploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $temp = explode(".", $_FILES["candidate_image"]["name"]);
        $newfilename = uniqid('cand_', true) . '.' . end($temp);
        $target_file = $target_dir . $newfilename;

        move_uploaded_file($_FILES["candidate_image"]["tmp_name"], $target_file);
        
        $image_name = $newfilename;
    }

    if (empty($errors_Update)) {
        $stmt = $pdo->prepare("UPDATE candidate_tbl
                       SET full_name = :full_name,
                           position_id = :position_id,
                           partylist_id = :partylist_id,
                           election_id = :election_id,
                           candidate_image = :candidate_image
                       WHERE candidate_id = :candidate_id");
        $stmt->execute([
            'full_name' => $full_name,
            'position_id' => $position_id,
            'partylist_id' => $partylist_id,
            'election_id' => $election_id,
            'candidate_image' => $image_name,
            'candidate_id' => $candidate_id
        ]);

        $action = "Updated Candidate: $full_name";
        $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $action]);

        addNotification($pdo, 'candidate_update', 'Updated candidate: ' . $full_name);
        $_SESSION['success_message'] = 'Candidate successfully updated!';
        header("Location: candidate_maintenance.php");
        exit;
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("SELECT full_name FROM candidate_tbl WHERE candidate_id = :id");
    $stmt->execute(['id' => $id]);
    $candidate = $stmt->fetch();

    $stmt = $pdo->prepare("DELETE FROM candidate_tbl WHERE candidate_id = :id");
    $stmt->execute(['id' => $id]);

    if ($candidate) {
        $action = "Deleted Candidate: " . $candidate['full_name'];
    } else {
        $action = "Attempted to delete non-existing candidate with ID: $id";
    }
    $stmt = $pdo->prepare("INSERT INTO system_logs (admin_id, action) VALUES (?, ?)");
    $stmt->execute([$_SESSION['admin_id'], $action]);

    if ($candidate) {
    addNotification($pdo, 'candidate_delete', 'Deleted candidate: ' . $candidate['full_name']);
    } else {
        addNotification($pdo, 'candidate_delete', 'Attempted to delete non-existing candidate with ID: ' . $id);
    }

    $_SESSION['success_message'] = 'Candidate successfully deleted!';
    header("Location: candidate_maintenance.php");
    exit();
}

$edit_candidate = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM candidate_tbl WHERE candidate_id = :id");
    $stmt->execute(['id' => $id]);
    $edit_candidate = $stmt->fetch();
}

$candidates = $pdo->query("
    SELECT c.*, p.position_name, pl.partylist_name, e.election_name
    FROM candidate_tbl c
    JOIN position_tbl p ON c.position_id = p.position_id
    JOIN partylist_tbl pl ON c.partylist_id = pl.partylist_id
    JOIN election_tbl e ON c.election_id = e.election_id
")->fetchAll();

$positions = $pdo->query("SELECT * FROM position_tbl")->fetchAll();
$partylists = $pdo->query("SELECT * FROM partylist_tbl WHERE deleted_at IS NULL")->fetchAll();
$elections = $pdo->query("SELECT * FROM election_tbl")->fetchAll();

function addNotification($pdo, $type, $message) {
    $stmt = $pdo->prepare("INSERT INTO candidate_notifs (type, message) VALUES (?, ?)");
    $stmt->execute([$type, $message]);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Candidate Maintenance</title>
    <link rel="stylesheet" href="candidate_maintenance.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
            <span class="navbar-title">Candidate Maintenance</span>
        </div>
        <div class="navbar-right">
            <a href="admin_dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
        </div>
    </nav>
    <?php if (!empty($success_message)): ?>
    <div id="notification" class="notification show">
        <?php echo $success_message; ?>
    </div>
    <?php endif; ?>
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
        <div class="forms-container <?= $edit_candidate ? 'split' : ''; ?>">
            <div class="form-section">
                <form method="POST" enctype="multipart/form-data" class="candidate-form">
                    <h2>Add New Candidate</h2>

                    <div class="image-upload-wrapper">
                        <div class="image-upload-container">
                            <label for="candidate_image">
                                <div class="candidate-image-placeholder">
                                    <span class="plus-icon">+</span>
                                </div>
                                <div class="overlay">Add Image</div>
                            </label>
                            <input type="file" id="candidate_image" name="candidate_image" accept="image/*" style="display:none;">
                        </div>
                    </div>

                    <label>Full Name:</label>
                    <input type="text" name="full_name" value="<?= (isset($_POST['add']) && isset($_POST['full_name'])) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
                    <?php if (isset($errors_Add['full_name'])): ?>
                        <p style="color:red;"><?= $errors_Add['full_name']; ?></p>
                    <?php endif; ?>
                        
                    <label>Position:</label>
                    <select name="position_id">
                        <option value="" disabled selected>Select Position</option>
                        <?php foreach ($positions as $pos): ?>
                            <option value="<?= $pos['position_id']; ?>" <?= (isset($_POST['add']) && isset($_POST['position_id']) && $_POST['position_id'] == $pos['position_id']) ? 'selected' : ''; ?>>
                                <?= $pos['position_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors_Add['position_id'])): ?>
                        <p style="color:red;"><?= $errors_Add['position_id']; ?></p>
                    <?php endif; ?>

                    <label>Partylist:</label>
                    <select name="partylist_id">
                        <option value="" disabled selected>Select Partylist</option>
                        <?php foreach ($partylists as $pl): ?>
                            <option value="<?= $pl['partylist_id']; ?>" <?= (isset($_POST['add']) && isset($_POST['partylist_id']) && $_POST['partylist_id'] == $pl['partylist_id']) ? 'selected' : ''; ?>>
                                <?= $pl['partylist_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors_Add['partylist_id'])): ?>
                        <p style="color:red;"><?= $errors_Add['partylist_id']; ?></p>
                    <?php endif; ?>

                    <label>Election:</label>
                    <select name="election_id">
                        <option value="" disabled selected>Select Election</option>
                        <?php foreach ($elections as $el): ?>
                            <option value="<?= $el['election_id']; ?>" <?= (isset($_POST['add']) && isset($_POST['election_id']) && $_POST['election_id'] == $el['election_id']) ? 'selected' : ''; ?>>
                                <?= $el['election_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors_Add['election_id'])): ?>
                        <p style="color:red;"><?= $errors_Add['election_id']; ?></p>
                    <?php endif; ?>

                    <button type="submit" name="add">Add Candidate</button>
                </form>
            </div>

            <?php if ($edit_candidate): ?>
            <div class="form-section edit">
                <form method="POST" enctype="multipart/form-data" class="candidate-form">
                    <h2>Edit Candidate</h2>
                    <input type="hidden" name="candidate_id" value="<?= $edit_candidate['candidate_id']; ?>">

                    <div class="image-upload-wrapper">
                        <div class="image-upload-container">
                            <label for="edit_candidate_image">
                                <?php
                                    $imageSrc = !empty($edit_candidate['candidate_image'])
                                        ? 'dbImgUploads/' . htmlspecialchars($edit_candidate['candidate_image'])
                                        : 'dbImgUploads/default_candidate_image.jpg';
                                ?>
                                <img src="<?= $imageSrc; ?>" alt="Candidate Image" class="candidate-image-preview" id="candidateImagePreview">
                                <div class="overlay">Change Image</div>
                            </label>
                            <input type="file" id="edit_candidate_image" name="candidate_image" accept="image/*" style="display:none;">
                        </div>
                    </div>

                    <label>Full Name:</label>
                    <input type="text" name="full_name" value="<?= isset($_POST['full_name']) && isset($_POST['update']) ? htmlspecialchars($_POST['full_name']) : htmlspecialchars($edit_candidate['full_name']); ?>">
                    <?php if (isset($errors_Update['full_name'])): ?>
                        <p style="color:red;"><?= $errors_Update['full_name']; ?></p>
                    <?php endif; ?>

                    <label>Position:</label>
                    <select name="position_id">
                        <?php foreach ($positions as $pos): ?>
                            <option value="<?= $pos['position_id']; ?>" <?= (isset($_POST['position_id']) && isset($_POST['update']) && $_POST['position_id'] == $pos['position_id']) || (!isset($_POST['update']) && $edit_candidate['position_id'] == $pos['position_id']) ? 'selected' : ''; ?>>
                                <?= $pos['position_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors_Update['position_id'])): ?>
                        <p style="color:red;"><?= $errors_Update['position_id']; ?></p>
                    <?php endif; ?>

                    <label>Partylist:</label>
                    <select name="partylist_id">
                        <?php foreach ($partylists as $pl): ?>
                            <option value="<?= $pl['partylist_id']; ?>" <?= (isset($_POST['partylist_id']) && isset($_POST['update']) && $_POST['partylist_id'] == $pl['partylist_id']) || (!isset($_POST['update']) && $edit_candidate['partylist_id'] == $pl['partylist_id']) ? 'selected' : ''; ?>>
                                <?= $pl['partylist_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors_Update['partylist_id'])): ?>
                        <p style="color:red;"><?= $errors_Update['partylist_id']; ?></p>
                    <?php endif; ?>

                    <label>Election:</label>
                    <select name="election_id">
                        <?php foreach ($elections as $el): ?>
                            <option value="<?= $el['election_id']; ?>" <?= (isset($_POST['election_id']) && isset($_POST['update']) && $_POST['election_id'] == $el['election_id']) || (!isset($_POST['update']) && $edit_candidate['election_id'] == $el['election_id']) ? 'selected' : ''; ?>>
                                <?= $el['election_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors_Update['election_id'])): ?>
                        <p style="color:red;"><?= $errors_Update['election_id']; ?></p>
                    <?php endif; ?>

                    <button type="submit" name="update">Update Candidate</button>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <div class="content-table">
            <h2>Existing Candidates</h2>
            <table>
                <tr>
                    <th>ID</th><th>Name</th><th>Position</th><th>Party</th><th>Election</th><th>Photo</th><th>Action</th>
                </tr>
                <?php foreach ($candidates as $cand): ?>
                <tr>
                    <td><?= $cand['candidate_id']; ?></td>
                    <td><?= $cand['full_name']; ?></td>
                    <td><?= $cand['position_name']; ?></td>
                    <td><?= $cand['partylist_name']; ?></td>
                    <td><?= $cand['election_name']; ?></td>
                    <td>
                        <?php
                            $imageFile = 'dbImgUploads/' . $cand['candidate_image'];
                            if (!file_exists($imageFile) || empty($cand['candidate_image'])) {
                                $imageFile = 'dbImgUploads/default_candidate_image.jpg';
                            }
                        ?>
                        <img src="<?= htmlspecialchars($imageFile); ?>" alt="Candidate Image" width="80">
                    </td>
                    <td>
                        <a href="candidate_maintenance.php?edit=<?= $cand['candidate_id']; ?>">Edit</a> |
                        <a href="candidate_maintenance.php?delete=<?= $cand['candidate_id']; ?>" onclick="return confirm('Delete this candidate?')">Delete</a>
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
    <script src="candidate_maintenance_script.js"></script>
</body>
</html>