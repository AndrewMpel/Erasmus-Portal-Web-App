<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include 'db.php';
    include 'profileData.php';

    if (isset($_SESSION['username'])) { 
        if (isset($_POST['change'])) {
            $new_name =  $_POST['name'];
            $new_email = $_POST['email'];
            $new_surname = $_POST['surname'];
            $new_phone =  $_POST['phone'];
            $new_student_id = $_POST['AM'];

            $updates = [];

            if (!empty($new_name) && $new_name !== $name) {
                $updates[] = "name = '$new_name'";
            }
            if (!empty($new_email) && $new_email !== $email) {
                $updates[] = "email = '$new_email'";
            }
            if (!empty($new_surname) && $new_surname !== $surname) {
                $updates[] = "surname = '$new_surname'";
            }
            if (!empty($new_phone) && $new_phone !== $phone) {
                $updates[] = "phone = '$new_phone'";
            }
            if (!empty($new_student_id) && $new_student_id !== $student_id) {
                $updates[] = "student_id = '$new_student_id'";
            }

            if (!empty($updates)) {
                $update_sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE username = '$username'";
                if (mysqli_query($conn, $update_sql)) {
                    header("location: ../frontend/html/profile.php");
                } else {
                    echo "Σφάλμα: " . mysqli_error($conn);
                }
            } else {
                echo "Δεν έκανες καμία αλλαγή";
            }
        }
    }
?>
