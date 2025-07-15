<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $position_id = $_POST['position_id'];
    $partylist_id = $_POST['partylist_id'];
    $election_id = $_POST['election_id'];

    $sql = "INSERT INTO candidate_tbl (full_name, position_id, partylist_id, election_id)
            VALUES ('$full_name', '$position_id', '$partylist_id', '$election_id')";

    if ($conn->query($sql) === TRUE) {
        $new_id = $conn->insert_id;
        $_SESSION['success'] = "Added Candidate #$new_id";
    } else {
        $_SESSION['success'] = "Error: " . $conn->error;
    }

    header("Location: candidates_index.php");
    exit;
}
?>
