<?php
session_start();
require_once "../connect.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// Add package
if(isset($_POST['add_package'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $features = mysqli_real_escape_string($conn, $_POST['features']); // features separated by newlines

    mysqli_query($conn, "INSERT INTO packages (name, price, features) VALUES ('$name', '$price', '$features')");
    header("Location: packages.php");
}
// Update package
if(isset($_POST['update_package'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $features = mysqli_real_escape_string($conn, $_POST['features']);

    mysqli_query($conn, "UPDATE packages SET name='$name', price='$price', features='$features' WHERE id=$id");
    header("Location: packages.php");
}

// Delete package
if(isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM packages WHERE id=$id");
    header("Location: packages.php");
}
// Edit package (fetch)
$edit_data = null;
if(isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $edit_query = mysqli_query($conn, "SELECT * FROM packages WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($edit_query);
}

// Fetch all packages
$packages = mysqli_query($conn, "SELECT * FROM packages ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Packages</title>
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
}

body {
    margin: 0;
    background: var(--bg);
    color: var(--text);
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
}

.main {
    flex:1;
    padding:20px;
}


h1, h2 {
    margin: 0 0 20px 0;
    color: var(--text);
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


.table-container {
    background: var(--card);
    padding: 20px;
    border-radius: 10px;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
}

th {
    text-align: left;
    padding: 12px;
    background: #11111f;
    color: #ddd;
}

td {
    padding: 12px;
    border-bottom: 1px solid #393952;
    vertical-align: top;
}

tr:hover td {
    background: #26263a;
}

td ul {
    padding-left: 20px;
    margin: 0;
}

td ul li {
    margin-bottom: 6px;
}

a {
    color: var(--accent);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s;
}

a:hover {
    color: var(--btn-hover);
} 
.btn-delete{background:#e74c3c;color:white;border-radius:6px;padding:6px 10px;display:inline-block;margin-top:6px;text-decoration:none;}
.btn-edit{background:#8e074a;color:white;border-radius:6px;padding:6px 10px;display:inline-block;margin-top:6px;text-decoration:none;}
</style>

</head>
<body>
<div class="main"> 
<!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>
    <h2><?= $edit_data ? 'Edit Package' : 'Add Package' ?></h2>

<form method="post">

    <?php if($edit_data): ?>
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
    <?php endif; ?>

    <input type="text" name="name" placeholder="Package Name" required value="<?= $edit_data['name'] ?? '' ?>">

    <input type="text" name="price" placeholder="Price (e.g. Rs 5000)" required value="<?= $edit_data['price'] ?? '' ?>">

    <textarea name="features" placeholder="Features (each on new line)" required><?= $edit_data['features'] ?? '' ?></textarea>

    <?php if($edit_data): ?>
        <button type="submit" name="update_package">Update Package</button>
        <a href="packages.php" style="color:#ccc;font-size:14px;">Cancel</a>
    <?php else: ?>
        <button type="submit" name="add_package">Add Package</button>
    <?php endif; ?>
</form>


    <h2>Existing Packages</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Features</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($packages)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['price']) ?></td>
            <td>
                <ul>
                    <?php
                    $features = explode("\n", $row['features']);
                    foreach($features as $feature) {
                        echo '<li>'.htmlspecialchars($feature).'</li>';
                    }
                    ?>
                </ul>
            </td>
            <td>
                <a href="packages.php?edit_id=<?= $row['id'] ?>" class="btn-edit">Edit</a> |
<a href="packages.php?delete_id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>

            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
