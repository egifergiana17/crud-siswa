CREATE DATABASE IF NOT EXISTS kampus;
USE kampus;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(100),
    status ENUM(
        'Aktif',
        'Cuti',
        'Lulus',
        'Mengundurkan Diri',
        'Drop Out',
        'Mutasi',
        'Wafat'
    ) DEFAULT 'Aktif'
);

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255)
);

INSERT INTO admin (username,password)
VALUES ('admin', MD5('admin123'));

