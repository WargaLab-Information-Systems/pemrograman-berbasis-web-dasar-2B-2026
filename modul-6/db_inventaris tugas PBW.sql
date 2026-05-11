CREATE DATABASE db_inventaris;
USE db_inventaris;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE coffee_beans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origin VARCHAR(100) NOT NULL,
    stock_kg DECIMAL(10,2) NOT NULL,
    roast_level ENUM('Light', 'Medium', 'Dark'),
    arrival_date DATE NOT NULL,
    is_organic TINYINT(1) DEFAULT 0
);

INSERT INTO users (username, password, role) 
VALUES ('eko', '$2y$10$8v5u7Lz7j8Z.5Vv1.o8XUunm0B/IeXlR7pU5a7LqH7L1z8J3H4y1i', 'admin');

DELETE FROM users WHERE username = 'eko';

INSERT INTO users (username, password, role) 
VALUES ('eko', '$2y$10$8v5u7Lz7j8Z.5Vv1.o8XUunm0B/IeXlR7pU5a7LqH7L1z8J3H4y1i', 'admin');

UPDATE users SET password = '$2y$10$8v5u7Lz7j8Z.5Vv1.o8XUunm0B/IeXlR7pU5a7LqH7L1z8J3H4y1i' WHERE username = 'eko';