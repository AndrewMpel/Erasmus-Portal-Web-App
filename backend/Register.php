<?php
    include 'db.php';

    if (isset($_POST['SignUp'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $am = $_POST['AM'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $checkUser = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($checkUser);
        if ($result->num_rows > 0) {
            echo "Username is already taken.";
        } else {
            $insertQuery = "INSERT INTO users (name, surname, student_id, email, phone, username, password)
                            VALUES ('$name', '$surname', '$am', '$email', '$phone', '$username', '$password')";
            if ($conn->query($insertQuery) === TRUE) {
                header("Location: ../frontend/html/Success.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    if (isset($_POST['LogIn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['AM'] = $row['student_id'];
                header("Location: ../frontend/html/index.php");
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            header("location: ../frontend/html/failure.php");
        }
    }
?>
