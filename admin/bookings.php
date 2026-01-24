<?php
session_start();
include "../connect.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Bookings</title>

<!-- Fonts + Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

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
    background: var(--bg);
    color: var(--text);
    font-family: Arial, sans-serif;
    display: flex;
}
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    border-radius: 6px;
    background: var(--accent);
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    margin-bottom: 15px;
    font-weight: 600;
}

.back-btn:hover {
    opacity: 0.8;
}


.main {
    flex:1;
    padding:20px;
}

h2 {
    margin:0 0 20px 0;
}

.table-container {
    background: var(--card);
    padding: 20px;
    border-radius:10px;
    overflow-x:auto;
}

table {
    width:100%;
    border-collapse: collapse;
}

th {
    text-align:left;
    padding:12px;
    background:#11111f;
    color:#ddd;
}

td {
    padding:10px;
    border-bottom:1px solid #393952;
}

tr:hover td {
    background:#26263a;
}

.pending { color: orange; font-weight:600; }
.approved { color: #1cc88a; font-weight:600; }
.cancelled { color: red; font-weight:600; }

.action a {
    color: var(--accent);
    text-decoration:none;
    font-weight:600;
}

.action a:hover {
    text-decoration:underline;
}
.btn-approve,
.btn-cancel,
.btn-delete {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-right: 6px;
    transition: 0.2s;
}

.btn-approve {
    background: #1cc88a; /* green */
    color: white;
}

.btn-approve:hover {
    background: #17a673;
}

.btn-cancel {
    background: #f6c23e; /* yellow/orange */
    color: #111;
}

.btn-cancel:hover {
    background: #dda20a;
}

.btn-delete {
    background: #e74a3b; /* red */
    color: white;
}

.btn-delete:hover {
    background: #c0392b;
}

</style>
</head>

<body>

<div class="main"> 
<!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>

<h2>Bookings</h2>

<div class="table-container">
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Package</th>
  <th>Date</th>
  <th>Status</th>
  <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM bookings ORDER BY created_at DESC");
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= $row['name'] ?></td>
  <td><?= $row['package'] ?></td>
  <td><?= $row['event_date'] ?></td>
  <td class="<?= $row['status'] ?>"><?= $row['status'] ?></td>
  <td class="action">
    <a onclick="return confirm('Approve this booking?')" href="update-booking.php?id=<?= $row['id'] ?>&status=approved" class="btn-approve">Approve</a> |
    <a onclick="return confirm('Cancel this booking?')" href="update-booking.php?id=<?= $row['id'] ?>&status=cancelled" class="btn-cancel">Cancel</a> |
    <a onclick="return confirm('Delete booking?')" href="delete-booking.php?id=<?= $row['id'] ?>" class="btn-delete">Delete</a>
  </td>
</tr>
<?php } ?>
</table>
</div>
</div>

</body>
</html>
