<?php
include 'connect2.php';
session_start();

// SIGN UP
if (isset($_POST['SignUp'])) {
    $firstName = $_POST['fName'];
    $lastName  = $_POST['lName'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email Address Already Exists !";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

        if ($stmt->execute()) {
            header("Location: index2.php?registered=1");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// SIGN IN
if (isset($_POST['SignIn'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['email'] = $row['email'];
        header("Location: homepage2.php");
        exit();
    } else {
        echo "Not found, Incorrect Email or Password";
    }
}
?>