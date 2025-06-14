<?php
session_start();
include 'db.php';
include 'profileData.php';

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => ''
];

if (isset($_SESSION['username'])) {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_surname = $_POST['surname'];
    $new_phone = $_POST['phone'];
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
            $response['success'] = true;
            $response['message'] = "Οι αλλαγές αποθηκεύτηκαν επιτυχώς.";
        } else {
            $response['message'] = "Σφάλμα κατά την αποθήκευση.";
        }
    } else {
        $response['message'] = "Δεν έγινε καμία αλλαγή.";
    }
} else {
    $response['message'] = "Παρακαλώ συνδεθείτε.";
}

echo json_encode($response);
exit();
