<?php
$conn = mysqli_connect("db", "root", "root", "crud_siswa");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
