<?php
include 'koneksi.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    mysqli_query($conn, "UPDATE siswa SET
        nama='$_POST[nama]',
        asal_sekolah='$_POST[asal_sekolah]',
        tempat_tanggal_lahir='$_POST[ttl]',
        alamat='$_POST[alamat]'
        WHERE id=$id
    ");

    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_array(
    mysqli_query($conn, "SELECT * FROM siswa WHERE id=$id")
);
?>

<h2>Edit Data Siswa</h2>
<form method="post">
Nama:<br>
<input type="text" name="nama" value="<?= $data['nama']; ?>"><br><br>

Asal Sekolah:<br>
<input type="text" name="asal_sekolah" value="<?= $data['asal_sekolah']; ?>"><br><br>

Tempat, Tanggal Lahir:<br>
<input type="text" name="ttl" value="<?= $data['tempat_tanggal_lahir']; ?>"><br><br>

Alamat:<br>
<textarea name="alamat"><?= $data['alamat']; ?></textarea><br><br>

<button type="submit">Update</button>
</form>
