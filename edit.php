<?php
require_once "user.php";
$user = new User();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id   = $_GET['id'];
$data = $user->readById($id);

if (isset($_POST['submit'])) {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];

    if ($user->update($id, $nama, $email)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $data['email'] ?>" required><br><br>
        <button type="submit" name="submit">Update</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>
