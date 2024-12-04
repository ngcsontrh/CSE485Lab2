CREATE DATABASE lab2;
USE lab2;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role INT NOT NULL CHECK (role IN (0, 1)) -- 0: người dùng, 1: quản trị viên
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO users (username, password, role) 
VALUES 
('user1', 'password1', 0),
('user2', 'password2', 0),
('user3', 'password3', 0),
('admin1', 'password4', 1),
('admin2', 'password5', 1),
('user4', 'password6', 0),
('user5', 'password7', 0),
('user6', 'password8', 0),
('user7', 'password9', 0),
('admin3', 'password10', 1),
('user8', 'password11', 0),
('user9', 'password12', 0),
('user10', 'password13', 0),
('user11', 'password14', 0),
('admin4', 'password15', 1),
('user12', 'password16', 0),
('user13', 'password17', 0),
('user14', 'password18', 0),
('admin5', 'password19', 1),
('user15', 'password20', 0);

-- Chèn dữ liệu giả vào bảng categories
INSERT INTO categories (name)
VALUES
('Technology'),
('Health'),
('Sports'),
('Politics'),
('Entertainment'),
('Science'),
('Travel'),
('Education'),
('Food'),
('Business'),
('Lifestyle'),
('Environment'),
('Gaming'),
('Fashion'),
('Art'),
('History'),
('Movies'),
('Music'),
('Books'),
('Finance');

INSERT INTO news (title, content, image, category_id)
VALUES
('Title 1', 'Content of news 1', 'image1.jpg', 1),
('Title 2', 'Content of news 2', 'image2.jpg', 2),
('Title 3', 'Content of news 3', 'image3.jpg', 3),
('Title 4', 'Content of news 4', 'image4.jpg', 4),
('Title 5', 'Content of news 5', 'image5.jpg', 5),
('Title 6', 'Content of news 6', 'image6.jpg', 6),
('Title 7', 'Content of news 7', 'image7.jpg', 7),
('Title 8', 'Content of news 8', 'image8.jpg', 8),
('Title 9', 'Content of news 9', 'image9.jpg', 9),
('Title 10', 'Content of news 10', 'image10.jpg', 10),
('Title 11', 'Content of news 11', 'image11.jpg', 11),
('Title 12', 'Content of news 12', 'image12.jpg', 12),
('Title 13', 'Content of news 13', 'image13.jpg', 13),
('Title 14', 'Content of news 14', 'image14.jpg', 14),
('Title 15', 'Content of news 15', 'image15.jpg', 15),
('Title 16', 'Content of news 16', 'image16.jpg', 16),
('Title 17', 'Content of news 17', 'image17.jpg', 17),
('Title 18', 'Content of news 18', 'image18.jpg', 18),
('Title 19', 'Content of news 19', 'image19.jpg', 19),
('Title 20', 'Content of news 20', 'image20.jpg', 20);
