<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}
require "../connect.php";
?>
<!DOCTYPE html>
<html>
<head>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<title>Messages</title>

<style>
/* <?php include "theme.css"; ?> */
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
.message-box {
    background: var(--card);
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
    border-left: 4px solid var(--accent);
}
.message-box small { color:#bbb; } 


</style>
</head>
<body>

<div class="main">

<!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>

<h2>Messages</h2>


<?php
$result = mysqli_query($conn,"SELECT * FROM contact_messages ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="message-box">
  <h3><?= $row['name'] ?></h3>
  <p><?= $row['message'] ?></p>
  <small><?= $row['email'] ?></small>
</div>
<?php } ?>

</div>
</body>
</html>
