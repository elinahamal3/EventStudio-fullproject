<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin-login.php");
  exit();
}
include "../connect.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM bookings WHERE id=$id");

header("Location: bookings.php");
?>
