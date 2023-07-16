CREATE DATABASE myapp;
USE myapp;

CREATE TABLE users (
    id INT AUTO_INCREMENT,
    email VARCHAR(255),
    password VARCHAR(255),
    PRIMARY KEY(id)
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT,
    body TEXT NOT NULL,
    user_id INT,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
