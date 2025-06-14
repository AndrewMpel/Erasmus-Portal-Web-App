<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => ''
];

if (!isset($_SESSION['username'])) {
    $response['message'] = "Παρακαλώ συνδεθείτε.";
    echo json_encode($response);
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT name, surname, email, phone, student_id FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    $response['message'] = "Σφάλμα προετοιμασίας ανάκτησης δεδομένων: " . mysqli_error($conn);
    echo json_encode($response);
    exit();
}

mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$row = mysqli_fetch_assoc($result)) {
    $response['message'] = "Ο χρήστης δεν βρέθηκε.";
    echo json_encode($response);
    exit();
}

$name = $row['name'];
$surname = $row['surname'];
$email = $row['email'];
$phone = $row['phone'];
$student_id = $row['student_id'];
mysqli_stmt_close($stmt);

$new_name = trim($_POST['name'] ?? '');
$new_email = trim($_POST['email'] ?? '');
$new_surname = trim($_POST['surname'] ?? '');
$new_phone = trim($_POST['phone'] ?? '');
$new_student_id = trim($_POST['AM'] ?? '');

$updates = [];
$params = [];
$types = '';

if (!empty($new_name) && $new_name !== $name) {
    $updates[] = "name = ?";
    $params[] = $new_name;
    $types .= 's';
    $name = $new_name;
}
if (!empty($new_email) && $new_email !== $email) {
    $updates[] = "email = ?";
    $params[] = $new_email;
    $types .= 's';
    $email = $new_email;
}
if (!empty($new_surname) && $new_surname !== $surname) {
    $updates[] = "surname = ?";
    $params[] = $new_surname;
    $types .= 's';
    $surname = $new_surname;
}
if (!empty($new_phone) && $new_phone !== $phone) {
    $updates[] = "phone = ?";
    $params[] = $new_phone;
    $types .= 's';
    $phone = $new_phone;
}
if (!empty($new_student_id) && $new_student_id !== (string)$student_id) {
    if (is_numeric($new_student_id)) {
        $updates[] = "student_id = ?";
        $params[] = $new_student_id;
        $types .= 'i';
        $student_id = $new_student_id;
    } else {
        $response['message'] = "Ο Αριθμός Μητρώου πρέπει να είναι αριθμός.";
        echo json_encode($response);
        exit();
    }
}

if (!empty($updates)) {
    $update_sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE username = ?";
    $params[] = $username;
    $types .= 's';

    $stmt = mysqli_prepare($conn, $update_sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);

        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = "Οι αλλαγές αποθηκεύτηκαν επιτυχώς.";
            $response['updatedData'] = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'phone' => $phone,
                'student_id' => $student_id
            ];
        } else {
            $response['message'] = "Σφάλμα κατά την αποθήκευση: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        $response['message'] = "Σφάλμα προετοιμασίας δήλωσης: " . mysqli_error($conn);
    }
} else {
    $response['message'] = "Δεν έγινε καμία αλλαγή.";
    $response['updatedData'] = [
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'phone' => $phone,
        'student_id' => $student_id
    ];
}

echo json_encode($response);
exit();
?>