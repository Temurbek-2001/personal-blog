-- Create the users table
CREATE TABLE users
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    auth_key      VARCHAR(32)  NOT NULL,
    access_token  VARCHAR(255) UNIQUE,
    role          VARCHAR(50)  NOT NULL DEFAULT 'user',
    created_at    TIMESTAMP             DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP             DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the categories table
CREATE TABLE categories
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the posts table
CREATE TABLE posts
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT          NOT NULL,
    category_id INT          NOT NULL,
    title       VARCHAR(255) NOT NULL,
    content     TEXT         NOT NULL,
    view_count  INT          NOT NULL DEFAULT 0 COMMENT 'Number of views',
    created_at  TIMESTAMP             DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP             DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_posts_user_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_posts_category_id FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE RESTRICT
);

-- Create the post_images table
CREATE TABLE post_images
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    post_id    INT          NOT NULL,
    image_url  VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_post_images_post_id FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);

-- Insert default categories
INSERT INTO categories (name)
VALUES ('Technology'),
       ('Lifestyle'),
       ('Travel'),
       ('Education'),
       ('Health');


-- Insert into the users table
INSERT INTO users (username, email, password_hash, auth_key, access_token, role)
VALUES ('john_doe', 'john@example.com', 'hashedpassword1', 'authkey1', 'token1', 'user'),
       ('jane_smith', 'jane@example.com', 'hashedpassword2', 'authkey2', 'token2', 'admin'),
       ('alice_williams', 'alice@example.com', 'hashedpassword3', 'authkey3', 'token3', 'user'),
       ('bob_johnson', 'bob@example.com', 'hashedpassword4', 'authkey4', 'token4', 'user'),
       ('charlie_brown', 'charlie@example.com', 'hashedpassword5', 'authkey5', 'token5', 'user');

-- Insert into the categories table (already populated with defaults in the previous script)
-- You can add more categories here for testing
INSERT INTO categories (name)
VALUES ('Food'),
       ('Sports'),
       ('Entertainment'),
       ('Science'),
       ('Business');

-- Insert into the posts table
INSERT INTO posts (user_id, category_id, title, content, view_count)
VALUES (1, 1, 'Healthy Eating Habits', 'Content about healthy eating habits.', 10),
       (2, 2, 'Top Sports News', 'Latest updates on sports events.', 50),
       (3, 3, 'Movies to Watch in 2025', 'Content about upcoming movies.', 5),
       (4, 4, 'Discovering New Scientific Discoveries', 'Content about new scientific research.', 2),
       (5, 5, 'Business Strategies for 2025', 'Content about business trends in 2025.', 15);

-- Insert into the post_images table
INSERT INTO post_images (post_id, image_url)
VALUES (1, 'https://example.com/images/healthy_eating.jpg'),
       (2, 'https://example.com/images/sports_news.jpg'),
       (3, 'https://example.com/images/movies_2025.jpg'),
       (4, 'https://example.com/images/science_discoveries.jpg'),
       (5, 'https://example.com/images/business_strategies.jpg');
