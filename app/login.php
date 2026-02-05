<?php
session_start();
$conn = new mysqli("db", "root", "root", "kampus");

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $q = $conn->query("SELECT * FROM admin 
                       WHERE username='$user' AND password='$pass'");
    if ($q->num_rows > 0) {
        $_SESSION['login'] = true;
        $_SESSION['user']  = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | My Wastu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg,#0d6efd,#6ea8fe);
    height: 100vh;
}
.login-card {
    margin-top: 10%;
}
</style>
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-4">
<div class="card shadow login-card">
<div class="card-header bg-dark text-white text-center">
<h4>🔐 Login Admin</h4>
</div>
<div class="card-body">

<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">
<input class="form-control mb-3" name="username" placeholder="Username" required>
<input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
<button class="btn btn-primary w-100" name="login">
Masuk
</button>
</form>

</div>
</div>
<p class="text-center text-white mt-3">
© <?= date('Y') ?> My Wastu @ Salsabilla
</p>
</div>
</div>
</div>

</body>
</html>
