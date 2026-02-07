CREATE DATABASE crud_siswa;

USE crud_siswa;

CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    asal_sekolah VARCHAR(100),
    tempat_tanggal_lahir VARCHAR(100),
    alamat TEXT
);
