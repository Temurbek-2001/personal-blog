-- SQL Script for Personal Blog Website

-- Drop tables if they already exist
DROP TABLE IF EXISTS post_images;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS admins;

-- Admins table to store admin user details
CREATE TABLE admins (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(50) NOT NULL UNIQUE,
                        password_hash VARCHAR(255) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table to store blog post categories
CREATE TABLE categories (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(100) NOT NULL UNIQUE,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Posts table to store blog posts
CREATE TABLE posts (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       admin_id INT NOT NULL,
                       category_id INT NOT NULL,
                       title VARCHAR(255) NOT NULL,
                       content TEXT NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                       FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
                       FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

-- Post images table to store multiple images for a single post
CREATE TABLE post_images (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             post_id INT NOT NULL,
                             image_url VARCHAR(255) NOT NULL,
                             created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

-- Insert default admin for testing purposes (replace values later)
INSERT INTO admins (username, password_hash) VALUES
    ('admin1', 'password_hash_example'); -- Replace with a hashed password

-- Insert some default categories for testing
INSERT INTO categories (name) VALUES
                                  ('Technology'),
                                  ('Lifestyle'),
                                  ('Travel'),
                                  ('Education'),
                                  ('Health');
