<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate_id = $_POST['candidate_id'];
    $full_name = $_POST['full_name'];
    $position_id = $_POST['position_id'];
    $partylist_id = $_POST['partylist_id'];
    $election_id = $_POST['election_id'];

    $sql = "UPDATE candidate_tbl
            SET full_name='$full_name',
                position_id='$position_id',
                partylist_id='$partylist_id',
                election_id='$election_id'
            WHERE candidate_id='$candidate_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Updated Candidate #$candidate_id";
    } else {
        $_SESSION['success'] = "Error: " . $conn->error;
    }

    header("Location: candidates_index.php");
    exit;
}
?>
