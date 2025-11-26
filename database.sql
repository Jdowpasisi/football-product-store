-- Create database
CREATE DATABASE IF NOT EXISTS kickzone;
USE kickzone;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category ENUM('Football', 'Accessories', 'Shoes') NOT NULL,
    image VARCHAR(255),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cart table
CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    session_id VARCHAR(255),
    product_id INT,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Wishlist table
CREATE TABLE IF NOT EXISTS wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    session_id VARCHAR(255),
    product_id INT,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert sample products
-- Footballs (3 types)
INSERT INTO products (name, description, price, category, image, stock) VALUES
('Nike Premier League Strike', 'Official match ball replica with high-visibility graphics and Nike Aerowsculpt technology', 2499.00, 'Football', 'nike-ball.png', 25),
('Adidas UCL Club', 'UEFA Champions League official ball with machine-stitched construction for durability', 1999.00, 'Football', 'adidas-ball.png', 30),
('Puma Big Cat Training Ball', 'Perfect training ball with TPU material and 32-panel design for true flight', 1299.00, 'Football', 'puma-ball.png', 40),

-- Accessories (3 types)
('Nike Shin Guards', 'Lightweight protection with contoured shell and foam backing for comfort', 899.00, 'Accessories', 'shin-guards.png', 50),
('Football Stockings', 'Professional sports stockings with anti-slip technology and moisture control', 399.00, 'Accessories', 'stockings.png', 60),
('Puma Football Gloves', 'Goalkeeper gloves with superior grip and wrist support', 1499.00, 'Accessories', 'gloves.png', 35),

-- Shoes (2 types)
('Nike Mercurial Vapor', 'Lightweight speed boots with Flyknit upper and chevron studs for explosive acceleration', 8999.00, 'Shoes', 'nike-boots.png', 20),
('Adidas Predator Elite', 'Control boots with Controlframe outsole and rubber strike zone for precision', 9999.00, 'Shoes', 'adidas-boots.png', 15);
