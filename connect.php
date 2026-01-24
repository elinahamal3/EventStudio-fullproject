<?php
$servername = "localhost";  // usually localhost
$username = "root";         // your DB username
$password = "";             // your DB password
$dbname = "event_studio";  // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "DB Connection Failed: " . $conn->connect_error]));
}

// Optional: for UTF-8 support
$conn->set_charset("utf8");
?>
