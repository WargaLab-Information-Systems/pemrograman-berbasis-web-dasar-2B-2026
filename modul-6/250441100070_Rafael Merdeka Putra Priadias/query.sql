CREATE DATABASE IF NOT EXISTS nelayan_db;
USE nelayan_db;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY (username)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS inventaris (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nama_alat VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    stok INT(11) NOT NULL,
    harga_sewa DECIMAL(10,2) NOT NULL,
    status_kondisi ENUM('Baik', 'Rusak', 'Perbaikan') NOT NULL DEFAULT 'Baik',
    tgl_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=INNODB;

INSERT INTO inventaris (nama_alat, kategori, stok, harga_sewa, status_kondisi) VALUES 
('Jaring Gillnet', 'Jaring', 15, 75000.00, 'Baik'),
('GPS Garmin', 'Elektronik', 5, 150000.00, 'Baik');

INSERT INTO users (username, PASSWORD, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
