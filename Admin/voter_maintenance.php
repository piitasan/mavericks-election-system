<?php
session_start();
require 'db_connect.php';
require 'version.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$voters = $pdo->query("SELECT * FROM user_tbl WHERE role='student' ORDER BY student_id ASC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voter Maintenance</title>
    <link rel="stylesheet" href="voter_maintenance.css">
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <button class="hamburger" onclick="toggleSidebar()">☰</button>
            <span class="navbar-title">Voter Maintenance</span>
        </div>
        <div class="navbar-right">
            <a href="admin_dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
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
        <div class="content-container">
            <div class="search-container">
                <h1>List of Student Voters 2025 Election</h1>
                <form onsubmit="return false;">
                    <input type="text" name="search" placeholder="Search by ID, Firstname, MI, Lastname">
                    <button type="button">Search</button>
                </form>
            </div>
            <div class="content-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>MI</th>
                            <th>Lastname</th>
                            <th>Suffix</th>
                            <th>Section</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="voter-table-body">

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Driven By Maverick Studio. All rights reserved.</p>
        <small>Version: <?= SYSTEM_VERSION ?></small>
    </footer>
    <script src="admin_dashboard_script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const tableBody = document.getElementById('voter-table-body');

            function fetchVoters(query = '') {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_voters.php?search=' + encodeURIComponent(query), true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        tableBody.innerHTML = xhr.responseText;
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="9">Failed to load data.</td></tr>';
                    }
                };
                xhr.send();
            }

            fetchVoters();

            searchInput.addEventListener('input', function() {
                fetchVoters(this.value);
            });
        });
    </script>
</body>
</html>
