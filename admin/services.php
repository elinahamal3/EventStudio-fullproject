<?php
session_start();
require_once "../connect.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// Add service
if(isset($_POST['add_service'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $icon_class = mysqli_real_escape_string($conn, $_POST['icon_class']);

    mysqli_query($conn, "INSERT INTO services (title, description, icon_class) VALUES ('$title', '$description', '$icon_class')");
    header("Location: services.php");
}
// Update service
if(isset($_POST['update_service'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $icon_class = mysqli_real_escape_string($conn, $_POST['icon_class']);

    mysqli_query($conn, "UPDATE services SET title='$title', description='$description', icon_class='$icon_class' WHERE id=$id");
    header("Location: services.php");
}

// Delete service
if(isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM services WHERE id=$id");
    header("Location: services.php");
}
// Edit service (fetch data)
$edit_data = null;
if(isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $edit_query = mysqli_query($conn, "SELECT * FROM services WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($edit_query);
}

// Fetch all services
$services = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Services</title> 
     <!-- Fonts + Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
:root {
    --bg: #1e1e2f;
    --sidebar: #11111f;
    --card: #2b2b3d;
    --text: #fff;
    --accent: #8e074a;
    --btn-hover: #a20f5c;
    --danger: #c0392b;
    --danger-hover: #e74c3c;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background: var(--bg);
    color: var(--text);
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    padding: 20px;
}

h1, h2 {
    margin-bottom: 20px;
    color: var(--text);
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

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
}

form input, form textarea {
    padding: 12px;
    border-radius: 6px;
    border: none;
    background: var(--card);
    color: var(--text);
    font-size: 14px;
    resize: vertical;
}

form input:focus, form textarea:focus {
    outline: 2px solid var(--accent);
}

form button {
    padding: 12px;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

form button:hover {
    background: var(--btn-hover);
}

.table-container {
    background: var(--card);
    padding: 20px;
    border-radius: 10px;
    overflow-x: auto;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
}

th {
    text-align: left;
    padding: 12px;
    background: var(--sidebar);
    color: #ddd;
}

td {
    padding: 12px;
    border-bottom: 1px solid #393952;
    vertical-align: middle;
}

tr:hover td {
    background: #26263a;
}

td i {
    font-size: 18px;
    color: var(--accent);
}

td a {
    color: var(--danger);
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s;
}

td a:hover {
    color: var(--danger-hover);
} 
.btn-delete{background:#e74c3c;color:white;border-radius:6px;padding:6px 10px;display:inline-block;margin-top:6px;text-decoration:none;}
.btn-edit{background:#8e074a;color:white;border-radius:6px;padding:6px 10px;display:inline-block;margin-top:6px;text-decoration:none;}

/* Responsive Table */
@media screen and (max-width: 768px) {
    table {
        min-width: 100%;
    }
    th, td {
        padding: 8px;
    }
    form input, form textarea, form button {
        font-size: 13px;
    }
}


</style>
</head>
<body>
  <div class="main">   
    <!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>
    <h2><?= $edit_data ? 'Edit Service' : 'Add Service' ?></h2>
<form method="post">

    <?php if($edit_data): ?>
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
    <?php endif; ?>

    <input type="text" name="title" placeholder="Service Title" required value="<?= $edit_data['title'] ?? '' ?>">

    <input type="text" name="icon_class" placeholder="FontAwesome Icon Class (e.g. fas fa-ring)" required value="<?= $edit_data['icon_class'] ?? '' ?>">

    <textarea name="description" placeholder="Description" required><?= $edit_data['description'] ?? '' ?></textarea>

    <?php if($edit_data): ?>
        <button type="submit" name="update_service">Update Service</button>
        <a href="services.php" style="color:#ccc; font-size:14px;">Cancel</a>
    <?php else: ?>
        <button type="submit" name="add_service">Add Service</button>
    <?php endif; ?>
</form>


    <h2>Existing Services</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Icon</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($services)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><i class="<?= $row['icon_class'] ?>"></i></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>
                <a href="services.php?edit_id=<?= $row['id'] ?>" class="btn-edit">Edit</a> |
<a href="services.php?delete_id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>

            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>
</body>
</html>
