<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../connect.php";

/* If already logged in, redirect to dashboard */
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Use this if your password is plain text
        if ($password == $row['password'] && $row['role'] === 'admin') {
    $_SESSION['admin_id'] = $row['id'];
    $_SESSION['admin_name'] = $row['name'];
    $_SESSION['login_source'] = 'admin_panel';
    header("Location: dashboard.php");
    exit;
        } else {
            $error = "Incorrect password";
        }
    } else {
        $error = "Admin not found";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
/* ----- General Body ----- */
body {
    font-family: 'Poppins', Arial, sans-serif;
    background: linear-gradient(135deg, #f5f5f5, #ffe6f0);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* ----- Login Container ----- */
.login-container {
    width: 380px;
    padding: 30px 25px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

/* ----- Heading ----- */
.login-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #8e074a;
}

/* ----- Inputs ----- */
input[type="email"], input[type="password"] {
    width: 90%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    transition: 0.3s;
}

input[type="email"]:focus, input[type="password"]:focus {
    border-color: #8e074a;
    box-shadow: 0 0 5px rgba(142,7,74,0.3);
}

/* ----- Button ----- */
button {
    width: 100%;
    margin-top: 15px;
    padding: 12px;
    background: #8e074a;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #a10c63;
    transform: translateY(-2px);
}

/* ----- Error Message ----- */
.error {
    color: red;
    font-weight: 600;
    text-align: center;
    margin-bottom: 10px;
    font-size: 14px;
}

</style>
</head>
<body>

<div class="login-container">
<h2>Admin Login</h2>
<?php if ($error) echo "<p class='error'>$error</p>"; ?>
<form method="POST" action="">
<input type="email" name="email" placeholder="Admin Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
</div>

</body>
</html>
