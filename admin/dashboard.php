<?php
session_start();
require_once "../connect.php";

if (empty($_SESSION['admin_id'])) {
    header("Location: ../backend/login.php"); 
    exit();
}

// === Query stats before HTML ===
$booking_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM bookings"))['total'];
$user_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM users WHERE role='user'"))['total'];
$message_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM contact_messages"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard | Event Studio</title>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
:root {
    --bg: #1e1e2f;
    --sidebar: #11111f;
    --card: #2b2b3d;
    --text: #fff;
    --accent: #8e074a;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: var(--bg);
    color: var(--text);
    display: flex;
}

.sidebar {
    width: 250px;
    background: var(--sidebar);
    height: 100vh;
    display: flex;
    flex-direction: column;
    padding: 20px;
}

.sidebar h2 { margin-bottom: 30px; text-align: center; }

.sidebar a {
    padding: 12px;
    color: var(--text);
    text-decoration: none;
    margin: 5px 0;
    border-radius: 5px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.2s;
}

.sidebar a i { width: 20px; text-align: center; }

.sidebar a:hover { background: var(--accent); }

.main { flex: 1; padding: 20px; }

.cards { display: flex; gap: 20px; margin-bottom: 20px; }

.card {
    flex: 1;
    background: var(--card);
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.card i {
    font-size: 32px;
    margin-bottom: 10px;
    color: var(--accent);
}

.card p { font-size: 28px; font-weight: bold; margin: 5px 0 0 0; }
.card h3 { margin: 0; font-size: 16px; color: #ccc; }
</style>
</head>
<body>

<div class="sidebar">
    <h2>Admin</h2>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
    <a href="bookings.php"><i class="fas fa-shopping-cart"></i>Bookings</a>
    <a href="users.php"><i class="fas fa-users"></i>Users</a>
    <a href="messages.php"><i class="fas fa-envelope"></i>Messages</a>
    <a href="our_work.php"><i class="fas fa-briefcase"></i>Our Work</a>
    <a href="services.php"><i class="fas fa-concierge-bell"></i>Services</a>
    <a href="packages.php"><i class="fas fa-box-open"></i>Packages</a>
    <a href="gallery.php"><i class="fas fa-image"></i>Gallery</a>
    <a href="/EVENTSTUDIO/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>



</div>

<div class="main"> 
<h1>Welcome, <?= $_SESSION['admin_name'] ?? 'Admin' ?></h1>

<!-- Top Cards -->
<div class="cards">
    <div class="card">
        <i class="fas fa-users"></i>
        <h3>New Users</h3>
        <p><?= $user_count ?></p>
    </div>
    <div class="card">
        <i class="fas fa-shopping-cart"></i>
        <h3>Total Orders</h3>
        <p><?= $booking_count ?></p>
    </div>
    <div class="card">
        <i class="fas fa-envelope"></i>
        <h3>Messages</h3>
        <p><?= $message_count ?></p>
    </div>
</div>

<!-- Chart -->
<canvas id="chart" style="background:#fff; border-radius:12px; padding:10px;"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['New Users', 'Total Orders', 'Messages'],
        datasets: [{
            label: 'Stats',
            data: [<?= $user_count ?>, <?= $booking_count ?>, <?= $message_count ?>],
            backgroundColor: ['#8e074a','#4e73df','#1cc88a']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

</body>
</html>
