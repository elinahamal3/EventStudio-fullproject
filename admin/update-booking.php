<?php
session_start();
include "../connect.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: bookings.php?error=invalid");
    exit();
}

$id = intval($_GET['id']);
$status = $_GET['status'];

$allowed = ['approved', 'cancelled'];

if (!in_array($status, $allowed)) {
    header("Location: bookings.php?error=invalid-status");
    exit();
}

$query = "UPDATE bookings SET status='$status' WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: bookings.php?success=status-updated");
} else {
    header("Location: bookings.php?error=db-failed");
}

exit();
?>
