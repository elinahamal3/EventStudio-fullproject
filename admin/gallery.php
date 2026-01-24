<?php
session_start();
require_once "../connect.php"; // adjust path based on your structure

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// Upload
if (isset($_POST['upload'])) {
    $file = $_FILES['image'];

    $filename = $file['name'];
    $tmp = $file['tmp_name'];

    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed = ["jpg", "jpeg", "png", "gif"];

    if (in_array($ext, $allowed)) {
        $newname = uniqid() . "." . $ext;
        $path = "../projectimages/" . $newname;

        if (move_uploaded_file($tmp, $path)) {
            $stmt = $conn->prepare("INSERT INTO gallery_images (image_name) VALUES (?)");
            $stmt->bind_param("s", $newname);
            $stmt->execute();
            $stmt->close();
            if ($msg = "Image uploaded successfully!"){
                echo "<script>alert('$msg');</script>";
            };
        } else {
            $msg = "Upload failed!";
        }
    } else {
        $msg = "Invalid file type!";
    }
}

// Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("SELECT image_name FROM gallery_images WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res) {
        $img = "../projectimages/" . $res['image_name'];
        if (file_exists($img)) unlink($img);

        $stmt2 = $conn->prepare("DELETE FROM gallery_images WHERE id=?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();
    }

    header("Location: gallery.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Gallery</title>
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
    padding: 20px;
}

.main {
    flex:1;
    padding:20px;
}

h2, h3 {
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
    opacity: .85;
}

form input[type="file"] {
    padding: 10px;
    border-radius: 6px;
    background: var(--card);
    border: none;
    color: var(--text);
    margin-bottom: 10px;
    width: fit-content;
}

form button {
    padding: 10px 16px;
    background: var(--accent);
    border: none;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: background .3s;
}
form button:hover {
    background: var(--btn-hover);
}

.gallery-item {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    background: var(--card);
    padding: 12px;
    border-radius: 10px;
    margin: 10px;
}

.gallery-item img {
    width: 160px;
    height: auto;
    border-radius: 6px;
    object-fit: cover;
    margin-bottom: 8px;
}

.btn-del {
    padding: 6px 10px;
    border-radius: 6px;
    background: var(--danger);
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
}
.btn-del:hover {
    background: var(--danger-hover);
}
</style>

</head>
<body>
<div class="main"> 
<!-- BACK BUTTON -->
<a href="dashboard.php" class="back-btn">
  <i class="fas fa-arrow-left"></i> Back
</a>
<h2>Manage Gallery</h2>

<?php if(isset($msg)) echo "<p><b>$msg</b></p>"; ?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit" name="upload">Upload</button>
</form>

<hr>

<h3>Gallery Images</h3>
<?php
$q = $conn->query("SELECT * FROM gallery_images ORDER BY uploaded_at DESC");
while ($row = $q->fetch_assoc()) {
    echo '<div class="gallery-item">';
    echo '<img src="../projectimages/'.$row['image_name'].'">';
    echo '<a class="btn-del" href="?delete='.$row['id'].'" onclick="return confirm(\'Delete this?\')">Delete</a>';
    echo '</div>';
}
?>

</body>
</html>
