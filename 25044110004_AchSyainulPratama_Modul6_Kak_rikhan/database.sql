CREATE DATABASE laundry_db;
USE laundry_db;

-- Tabel Users (Autentikasi & Role)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM('admin', 'user') DEFAULT 'user'
);

-- Tabel Pesanan (Data Utama - 5 Kolom bervariasi)
CREATE TABLE pesanan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_pelanggan VARCHAR(100) NOT NULL,
    jenis_layanan VARCHAR(50),
    berat_kg FLOAT,
    tgl_selesai DATE,
    status_bayar BOOLEAN DEFAULT 0
);

-- User Default (Password: admin123 & user123)
INSERT INTO users (username, PASSWORD, ROLE) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');