<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
$conn = new mysqli("db", "root", "root", "kampus");
if ($conn->connect_error) {
    die("Koneksi gagal");
}

// CREATE & UPDATE
if (isset($_POST['simpan'])) {
    $id = $_POST['id'] ?? '';
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    if ($id == '') {
        $conn->query("INSERT INTO mahasiswa 
        (nama, tempat_lahir, tanggal_lahir, alamat, telepon, email, status)
        VALUES ('$nama','$tempat_lahir','$tanggal_lahir','$alamat','$telepon','$email','$status')");
    } else {
        $conn->query("UPDATE mahasiswa SET
            nama='$nama',
            tempat_lahir='$tempat_lahir',
            tanggal_lahir='$tanggal_lahir',
            alamat='$alamat',
            telepon='$telepon',
            email='$email',
            status='$status'
            WHERE id=$id");
    }
    header("Location: index.php");
    exit;
}

// DELETE (untuk pembelajaran)
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM mahasiswa WHERE id=".$_GET['hapus']);
    header("Location: index.php");
    exit;
}

// EDIT DATA
$edit = null;
if (isset($_GET['edit'])) {
    $res = $conn->query("SELECT * FROM mahasiswa WHERE id=".$_GET['edit']);
    $edit = $res->fetch_assoc();
}

// READ
$data = $conn->query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>My Wastu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style> body { background:#f4f6f9; } </style>
</head>
<body>

<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">📘 My Wastu</h3>
        <small class="text-muted">
            Login sebagai: <strong><?= $_SESSION['user'] ?? 'Admin' ?></strong>
        </small>
    </div>

    <a href="logout.php"
       onclick="return confirm('Yakin ingin logout?')"
       class="btn btn-outline-danger btn-sm">
        🚪 Logout
    </a>
</div>

<div class="row">
<div class="col-md-4">
<div class="card shadow">
<div class="card-header bg-primary text-white">
<?= $edit ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' ?>
</div>
<div class="card-body">

<form method="post">
<input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

<input class="form-control mb-2" name="nama" placeholder="Nama" value="<?= $edit['nama'] ?? '' ?>" required>
<input class="form-control mb-2" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $edit['tempat_lahir'] ?? '' ?>">
<input class="form-control mb-2" type="date" name="tanggal_lahir" value="<?= $edit['tanggal_lahir'] ?? '' ?>">
<textarea class="form-control mb-2" name="alamat" placeholder="Alamat"><?= $edit['alamat'] ?? '' ?></textarea>
<input class="form-control mb-2" name="telepon" placeholder="No. Telepon" value="<?= $edit['telepon'] ?? '' ?>">
<input class="form-control mb-2" type="email" name="email" placeholder="Email" value="<?= $edit['email'] ?? '' ?>">

<select class="form-control mb-3" name="status">
<?php
$statusList = ['Aktif','Cuti','Lulus','Mengundurkan Diri','Drop Out','Mutasi','Wafat'];
foreach ($statusList as $s) {
    $sel = ($edit && $edit['status']==$s) ? 'selected' : '';
    echo "<option $sel>$s</option>";
}
?>
</select>

<button class="btn btn-success w-100" name="simpan">
<?= $edit ? '💾 Update' : '➕ Simpan' ?>
</button>
</form>

</div>
</div>
</div>

<div class="col-md-8">
<div class="card shadow">
<div class="card-header bg-dark text-white">Data Mahasiswa</div>
<div class="card-body">
<table class="table table-bordered table-striped small">
<thead class="table-secondary">
<tr>
<th>No</th>
<th>Nama</th>
<th>TTL</th>
<th>Alamat</th>
<th>Telepon</th>
<th>Email</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=1; while($r=$data->fetch_assoc()): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= htmlspecialchars($r['nama']) ?></td>
<td><?= $r['tempat_lahir'] ?>, <?= $r['tanggal_lahir'] ?></td>
<td><?= $r['alamat'] ?></td>
<td><?= $r['telepon'] ?></td>
<td><?= $r['email'] ?></td>
<td>
<span class="badge bg-info"><?= $r['status'] ?></span>
</td>
<td>
<a href="?edit=<?= $r['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

<footer class="text-center mt-3 text-muted">
© <?= date('Y') ?> | Salsabilla
</footer>
</div>

</body>
</html>