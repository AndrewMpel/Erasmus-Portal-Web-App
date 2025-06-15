<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['start']) && !empty($_POST['end'])) {
        $start = $_POST['start'];
        $end = $_POST['end'];

        $conn->query("DELETE FROM application_period");

        
        $stmt = $conn->prepare("INSERT INTO application_period (`start`, `end`) VALUES (?, ?)");
        
        
        if ($stmt) {
            $stmt->bind_param("ss", $start, $end);
            
        
            if ($stmt->execute()) {
            
            } else {
                
                echo "Error executing statement: " . $stmt->error;
            }
            $stmt->close();
        } else {
            
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Συμπλήρωσε και τις δύο ημερομηνίες.";
    }
}
$conn->close();
?>