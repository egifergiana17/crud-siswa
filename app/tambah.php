<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    mysqli_query($conn, "INSERT INTO siswa VALUES (
        NULL,
        '$_POST[nama]',
        '$_POST[asal_sekolah]',
        '$_POST[ttl]',
        '$_POST[alamat]'
    )");

    header("Location: index.php");
    exit;
}
?>

<h2>Tambah Data Siswa</h2>
<form method="post">
Nama:<br>
<input type="text" name="nama"><br><br>

Asal Sekolah:<br>
<input type="text" name="asal_sekolah"><br><br>

Tempat, Tanggal Lahir:<br>
<input type="text" name="ttl"><br><br>

Alamat:<br>
<textarea name="alamat"></textarea><br><br>

<button type="submit">Simpan</button>
</form>
