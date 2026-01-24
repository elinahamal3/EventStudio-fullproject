<?php
session_start();

// Determine login source before destroying session
$login_source = $_SESSION['login_source'] ?? 'frontend';

session_unset();
session_destroy();

// Redirect based on login source
if ($login_source === 'admin_panel') {
    header("Location: /EVENTSTUDIO/admin/admin-login.php");
} else {
    header("Location: /EVENTSTUDIO/index.php");
}
exit();
?>
