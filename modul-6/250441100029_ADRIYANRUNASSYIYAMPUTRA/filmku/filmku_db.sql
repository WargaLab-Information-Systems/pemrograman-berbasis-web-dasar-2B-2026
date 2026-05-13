CREATE DATABASE filmku_db;
use filmku_db;

CREATE TABLE users (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  username    VARCHAR(50) NOT NULL UNIQUE,
  email       VARCHAR(100) NOT NULL UNIQUE,
  password    VARCHAR(255) NOT NULL,
  role        ENUM('admin','user') DEFAULT 'user',
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE films (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  judul       VARCHAR(200) NOT NULL,
  genre       VARCHAR(100) NOT NULL,
  tahun       YEAR NOT NULL,
  durasi      INT NOT NULL,
  rating      DECIMAL(3,1) NOT NULL,
  sinopsis    TEXT,
  created_by  INT,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id)
);


-- Password: admin123 (sudah di-hash)
INSERT INTO users (username, email, password, role) VALUES (
  'admin',
  'admin@filmku.com',
  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
  'admin'
);

INSERT INTO users (username, email, password, role) VALUES (
'adminIYAN','admintertinggi@gmail.com','hujikoko','admin'
);

select * from users;


UPDATE users 
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
WHERE username = 'adminIYAN';
truncate users;

UPDATE users 
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
WHERE username = 'admin';

