<?php
    session_start();
    include 'db.php';

    $username = $_SESSION['username'];

    $sql = "SELECT id FROM users WHERE username = ?";
    $x = $conn->prepare($sql);
    $x->bind_param("s", $username);
    $x->execute();
    $result = $x->get_result();

    if ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
    } else {
        echo "Ο χρήστης δεν βρέθηκε";
    }
    $sql = "SELECT user_id FROM applications WHERE user_id = ?";
    $x = $conn->prepare($sql);
    $x->bind_param("i", $user_id);
    $x->execute();
    $result = $x->get_result();

    if ($row = $result->fetch_assoc()) {
       header("location: ../frontend/html/failure.php");
    } else {
        $uploadDir = __DIR__ . '/Files/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        function handleUpload($fileInput, $uploadDir) {
            if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== UPLOAD_ERR_OK) {
                return null;
            }
            $file = $_FILES[$fileInput];
            $originalName = basename($file['name']);
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $uniqueName = uniqid() . "." . $extension;
            $filePath = $uploadDir . $uniqueName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                return 'backend/Files/' . $uniqueName;
            }
            return null;
        }


        $gradesPath = handleUpload('grades', $uploadDir);
        $languageCertPath = handleUpload('language_certificate', $uploadDir);
        $languageCert2Path = handleUpload('language_certificate2', $uploadDir);

        $passed_courses = $_POST['percentage'];
        $average = $_POST['average'];
        $english = $_POST['english'];
        $languages = $_POST['languages'];
        $firstChoice = (int)$_POST['1st-Choice'];
        $secondChoice = (int)$_POST['2nd-Choice'];
        $thirdChoice = (int)$_POST['3rd-Choice'];
        $agree = isset($_POST['Agree']) ? 1 : 0;

        $x = $conn->prepare("INSERT INTO applications (
            user_id, pass_percentage, average, english_level, other_langs,
            uni_1, uni_2, uni_3,
            grade_file, english_file, otherlangs_file, terms
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $x->bind_param("iddsiiiisssi",
            $user_id, $passed_courses, $average, $english, $languages,
            $firstChoice, $secondChoice, $thirdChoice,
            $gradesPath, $languageCertPath, $languageCert2Path, $agree
        );
        if ($x->execute()) {
            echo "Η αίτηση υποβλήθηκε";
            header("location: ../frontend/html/Success.php");
        } else {
            header("location: ../frontend/html/failure.php");
        }
        
        $x->close();
        $conn->close();
    }
    
?>
