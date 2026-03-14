<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "You need to login before booking"
    ]);
    exit;
}

header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/Exception.php";

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid JSON data"]);
    exit;
}

// Assign values safely
$package    = $data['package'] ?? '';
$name       = $data['name'] ?? '';
$email      = $data['email'] ?? '';
$phone      = $data['phone'] ?? '';
$event_date = $data['event_date'] ?? '';
$location   = $data['location'] ?? '';
$message    = $data['message'] ?? '';

// Validation
if (!$package || !$name || !$email || !$phone || !$event_date || !$location) {
    echo json_encode(["success" => false, "message" => "All required fields must be filled"]);
    exit;
}

// Insert into database
$stmt = $conn->prepare("
    INSERT INTO bookings (package, name, email, phone, event_date, location, message)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param(
    "sssssss",
    $package,
    $name,
    $email,
    $phone,
    $event_date,
    $location,
    $message
);

if ($stmt->execute()) {
echo json_encode([
        "success" => true,
        "message" => "Booking saved successfully! Confirmation email will be sent shortly."
    ]);
    session_write_close();
    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }
    // ===== Send Email Confirmation =====
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // using SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'youremail@gmail.com'; // Your email
        $mail->Password   = 'yourapppassword';   // Use App Password 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('youremail@gmail.com', 'Event Studio');
        $mail->addAddress($email, $name); // user details will occur 

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation - Event Studio';
        $mail->Body    = "
            <h2>Hi $name,</h2>
            <p>Thank you for booking with Event Studio!</p>
            <p><strong>Booking Details:</strong></p>
            <ul>
                <li>Package: $package</li>
                <li>Event Date: $event_date</li>
                <li>Location: $location</li>
                <li>Phone: $phone</li>
                <li>Message: $message</li>
            </ul>
            <p>We will contact you soon to confirm your booking.</p>
            <p>Best regards,<br>Event Studio Team</p>
        ";

        $mail->send();
    //     echo json_encode(["success" => true, "message" => "Booking saved and email sent successfully!"]);
    } catch (Exception $e) {
        echo json_encode(["success" => true, "message" => "Booking saved, but email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }

} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
