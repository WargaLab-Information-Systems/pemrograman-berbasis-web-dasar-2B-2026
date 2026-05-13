CREATE DATABASE sepatu
USE sepatu

DROP DATABASE sepatu
DROP TABLE USER

CREATE TABLE USER (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    username VARCHAR(100),
    PASSWORD VARCHAR(100),
    ROLE ENUM('Admin','User')
);

CREATE TABLE sepatu (
    id_sepatu INT AUTO_INCREMENT PRIMARY KEY,
    nama_sepatu VARCHAR(100),
    merk VARCHAR(100),
    ukuran INT,
    harga DECIMAL(10,2),
    stok INT
);

CREATE TABLE pembelian(
id_beli INT AUTO_INCREMENT  PRIMARY KEY,
id_user INT,
id_sepatu INT,
jumlah INT,
tanggal DATE,

FOREIGN KEY (id_user) REFERENCES USER(id_user) ON DELETE CASCADE,
FOREIGN KEY (id_sepatu)REFERENCES sepatu(id_sepatu) ON DELETE CASCADE
);

SELECT * FROM USER
SELECT * FROM sepatu
SELECT * FROM pembelian