<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include 'db.php';

    if (isset($_SESSION['username'])) { 
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);
        $sql = "SELECT name, surname, email, phone, student_id FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $surname = $row['surname'];
            $phone = $row['phone'];
            $student_id = $row['student_id'];
        } else {
            echo "Δεν βρέθηκαν στοιχεία.";
            exit();
        }
    }
?>
