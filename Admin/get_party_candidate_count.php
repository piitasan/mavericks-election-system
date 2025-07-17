<?php
require 'db_connect.php';

if (isset($_GET['partylist_id'])) {
    $partylist_id = $_GET['partylist_id'];

    $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM candidate_tbl WHERE partylist_id = ?");
    $stmt->execute([$partylist_id]);
    $result = $stmt->fetch();

    echo json_encode(['count' => $result['total']]);
}
?>
