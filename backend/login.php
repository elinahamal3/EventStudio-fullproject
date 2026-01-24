<?php 
session_start();
require_once __DIR__ . "/../connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        echo "<script>alert('Email not found'); location.href='../login.php';</script>";
        exit();
    }

    $user = $result->fetch_assoc();

    // === ADMIN LOGIN === (PLAIN PASSWORD)
    if ($user['role'] === 'admin') {

        // If admin is using plain password check
        if ($password === $user['password']) {
            $_SESSION['admin'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];

            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect admin password'); location.href='../login.php';</script>";
            exit();
        }
    }

    // === NORMAL USER LOGIN === (HASH VERIFY)
    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email']= $email;

        // Redirect for booking
        if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
            header("Location: ../" . $_GET['redirect']);
            exit();
        }

        header("Location: ../index.php");
        exit();

    } else {
        echo "<script>alert('Incorrect password'); location.href='../login.php';</script>";
        exit();
    }
}
?>
