-- Create users table
CREATE TABLE `users` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `username` VARCHAR(50) NOT NULL UNIQUE,
                         `email` VARCHAR(100) NOT NULL UNIQUE,
                         `password_hash` VARCHAR(255) NOT NULL,
                         `auth_key` VARCHAR(32) NOT NULL,
                         `access_token` VARCHAR(255) UNIQUE,
                         `role` VARCHAR(50) NOT NULL DEFAULT 'user',
                         `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create categories table
CREATE TABLE `categories` (
                              `id` INT AUTO_INCREMENT PRIMARY KEY,
                              `name` VARCHAR(100) NOT NULL UNIQUE,
                              `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create posts table
CREATE TABLE `posts` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `user_id` INT NOT NULL,
                         `category_id` INT NOT NULL,
                         `title` VARCHAR(255) NOT NULL,
                         `content` TEXT NOT NULL,
                         `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
                         FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT
);

-- Create post_images table
CREATE TABLE `post_images` (
                               `id` INT AUTO_INCREMENT PRIMARY KEY,
                               `post_id` INT NOT NULL,
                               `image_url` VARCHAR(255) NOT NULL,
                               `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                               FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE
);

-- Insert default categories for testing
INSERT INTO `categories` (`name`) VALUES
                                      ('Technology'),
                                      ('Lifestyle'),
                                      ('Travel'),
                                      ('Education'),
                                      ('Health');
