<?php include 'koneksi.php'; ?>
<h2>Data Siswa</h2>
<a href="tambah.php">Tambah Siswa</a>
<table border="1" cellpadding="8">
<tr>
  <th>Nama</th>
  <th>Asal Sekolah</th>
  <th>Tempat, Tgl Lahir</th>
  <th>Alamat</th>
  <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM siswa");
while ($d = mysqli_fetch_array($data)) {
?>
<tr>
  <td><?= $d['nama']; ?></td>
  <td><?= $d['asal_sekolah']; ?></td>
  <td><?= $d['tempat_tanggal_lahir']; ?></td>
  <td><?= $d['alamat']; ?></td>
  <td>
    <a href="edit.php?id=<?= $d['id']; ?>">Edit</a> |
    <a href="hapus.php?id=<?= $d['id']; ?>">Hapus</a>
  </td>
</tr>
<?php } ?>
</table>
