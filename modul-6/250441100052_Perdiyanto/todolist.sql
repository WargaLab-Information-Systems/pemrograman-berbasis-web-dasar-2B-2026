CREATE DATABASE todolist;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    PASSWORD VARCHAR(255)
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    judul VARCHAR(255),
    deskripsi TEXT,
    deadline DATE,
    STATUS ENUM('Belum', 'Selesai'),

    FOREIGN KEY (user_id) REFERENCES users(id)
);

SELECT * FROM users
WHERE nama = 'perdi';

INSERT INTO users (nama, email, PASSWORD) VALUES
('Perdiyanto', 'perdi@gmail.com', '12345'),
('Budi', 'budi@gmail.com', '12345'),
('Sinta', 'sinta@gmail.com', '12345');

delete from users
where id = 2;

INSERT INTO tasks (user_id, judul, deskripsi, deadline, status) VALUES
(1, 'Belajar PHP', 'Mempelajari CRUD PHP dan MySQL', '2026-05-10', 'Belum');
