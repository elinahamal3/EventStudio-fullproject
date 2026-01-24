<?php
session_start();
require_once "../connect.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// Add new item
if(isset($_POST['add'])){
    $label = mysqli_real_escape_string($conn, $_POST['label']);
    $file = $_FILES['image'];

    if($file['name'] != ""){
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ["jpg","jpeg","png","webp"];

        if(in_array($ext,$allowed)){
            $newname = uniqid().".".$ext;
            move_uploaded_file($file['tmp_name'], "../projectimages/".$newname);

            mysqli_query($conn,"INSERT INTO our_work(image,label) VALUES('$newname','$label')");
        }
    }
    header("Location: our_work.php");
}

// Delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $q = mysqli_query($conn, "SELECT image FROM our_work WHERE id=$id");
    $row = mysqli_fetch_assoc($q);

    if($row){
        $file = "../projectimages/".$row['image'];
        if(file_exists($file)) unlink($file);
    }
    mysqli_query($conn, "DELETE FROM our_work WHERE id=$id");

    header("Location: our_work.php");
    exit;
}

// Fetch
$items = mysqli_query($conn,"SELECT * FROM our_work ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Our Work</title>
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


body{background:#1e1e2f;color:white;font-family:Arial;padding:20px;}
.card{background:#2b2b3d;width:180px;padding:10px;border-radius:10px;margin:10px;display:inline-block;text-align:center;}
.card img{width:160px;height:120px;object-fit:cover;border-radius:6px;}
.btn-delete{background:#e74c3c;color:white;border-radius:6px;padding:6px 10px;display:inline-block;margin-top:6px;text-decoration:none;
}


</style>
</head>
<body>
<div class="main"> 
<!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>
<h2>Manage Our Work</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" required><br><br>
    <input type="text" name="label" placeholder="Label (ex: Stage)" required><br><br>
    <button type="submit" name="add">Add</button>
</form>

<hr>

<?php while($row = mysqli_fetch_assoc($items)): ?>
<div class="card">
    <img src="../projectimages/<?= $row['image'] ?>">
    <p><?= htmlspecialchars($row['label']) ?></p>

    <a href="?delete=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete?')">Delete</a>
</div>
<?php endwhile; ?>

</body>
</html>
