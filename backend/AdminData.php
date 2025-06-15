<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['start']) && !empty($_POST['end'])) {
        $start = $_POST['start'];
        $end = $_POST['end'];

        // Διαγραφή παλιών τιμών
        $conn->query("DELETE FROM application_period");

        // Εισαγωγή νέας περιόδου
        $stmt = $conn->prepare("INSERT INTO application_period (`start`, `end`) VALUES (?, ?)");
        $stmt->bind_param("ss", $start, $end);

        $stmt->close();
    } else {
        echo "Συμπλήρωσε και τις δύο ημερομηνίες.";
    }
}
$conn->close();
?>