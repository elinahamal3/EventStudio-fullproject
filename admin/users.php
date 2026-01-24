<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}
include '../connect.php';
?>
<!DOCTYPE html>
<html> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<head>
<title>Manage Users</title>
<style>
/* <?php include "theme.css"; ?>  */
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
.btn-delete{background:#e74c3c;color:white;border-radius:6px;padding:6px 10px;display:inline-block;margin-top:6px;text-decoration:none;}
</style>
</head>
<body>
<div class="main">

<!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>

<h2>Users</h2>


<div class="table-container">
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Email</th>
  <th>Role</th>
  <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM users");
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= $row['name'] ?></td>
  <td><?= $row['email'] ?></td>
  <td><?= $row['role'] ?></td>
  <td class="action">
    <a onclick="return confirm('Delete user?')" href="delete.php?user=<?= $row['id'] ?>" class="btn-delete">Delete</a>
  </td>
</tr>
<?php } ?>
</table>
</div>

</div>
</body>
</html>
