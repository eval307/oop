<?php
require_once "user.php";

$user = new User();

// ====== TAMBAH DATA ======
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $user->create($nama, $email);
    header("Location: index.php");
    exit;
}

// ====== UPDATE DATA ======
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $user->update($id, $nama, $email);
    header("Location: index.php");
    exit;
}

// ====== HAPUS DATA ======
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $user->delete($id);
    header("Location: index.php");
    exit;
}

// ====== AMBIL DATA UNTUK DIEDIT (READ BY ID) ======
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $user->readById($id);
}

$dataUser = $user->read();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OOP PHP (Satu File)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #333; }
        form { margin-bottom: 20px; }
        input { padding: 8px; margin: 4px; }
        button { padding: 8px 12px; cursor: pointer; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        th { background: #f2f2f2; }
        a { text-decoration: none; color: blue; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h1>CRUD OOP PHP</h1>

    <!-- Form Tambah / Edit -->
    <form method="POST">
        <?php if ($editData): ?>
            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <input type="text" name="nama" value="<?= $editData['nama'] ?>" required>
            <input type="email" name="email" value="<?= $editData['email'] ?>" required>
            <button type="submit" name="update">Update</button>
            <a href="index.php">Batal</a>
        <?php else: ?>
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="tambah">Tambah</button>
        <?php endif; ?>
    </form>

    <!-- Tabel Data User -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($dataUser)): ?>
            <?php foreach ($dataUser as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>| 
                        <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Belum ada data.</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>
