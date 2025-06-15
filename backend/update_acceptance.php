<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appId = intval($_POST['id']);
    $isAccepted = isset($_POST['accepted']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE applications SET is_accepted = ? WHERE id = ?");
    $stmt->bind_param("ii", $isAccepted, $appId);
    $stmt->execute();
    $stmt->close();

    echo "success";
}
?>