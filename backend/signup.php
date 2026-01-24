<?php
session_start();
require_once __DIR__ . "/../connect.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Password length check
    if (strlen($password) < 6) {
        echo "<script>
            alert('Password must be at least 6 characters');
            window.location.href='../signup.php';
        </script>";
        exit;
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>
            alert('Email already registered');
            window.location.href='../login.php';
        </script>";
        exit;
    }

    // Hash password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $name, $email, $hashed);

    if ($stmt->execute()) {
    if (isset($_GET['redirect'])) {
        // signup from booking → go to login with redirect
        header("Location: ../login.php?redirect=" . $_GET['redirect']);
        exit();
    }
    header("Location: ../login.php"); // normal signup
    exit();
}

        else {
        echo "<script>
            alert('Signup failed');
            window.location.href='../signup.php';
        </script>";
    }
}
?>
