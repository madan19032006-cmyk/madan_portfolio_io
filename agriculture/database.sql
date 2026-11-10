CREATE DATABASE IF NOT EXISTS agriculture_management
CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE agriculture_management;

-- Simple BCA mini-project database: no foreign keys
CREATE TABLE IF NOT EXISTS crops (
  id INT AUTO_INCREMENT PRIMARY KEY,
  crop_name VARCHAR(100) NOT NULL,
  season VARCHAR(40) NOT NULL,
  quantity_kg DECIMAL(10,2) NOT NULL DEFAULT 0,
  price_per_kg DECIMAL(10,2) NOT NULL DEFAULT 0,
  planting_date DATE NULL,
  notes TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS farmers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  farmer_name VARCHAR(120) NOT NULL,
  phone VARCHAR(20) NULL,
  location VARCHAR(150) NULL,
  land_acres DECIMAL(8,2) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS sales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  crop_id INT NOT NULL,
  buyer_name VARCHAR(120) NOT NULL,
  quantity_kg DECIMAL(10,2) NOT NULL,
  amount DECIMAL(12,2) NOT NULL DEFAULT 0,
  sale_date DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional sample data; remove these INSERTs if you want an empty database.
INSERT INTO crops (crop_name, season, quantity_kg, price_per_kg, planting_date, notes) VALUES
('Rice', 'Kharif', 1200.00, 32.00, '2026-06-15', 'Sample record'),
('Tomato', 'Zaid', 450.00, 25.00, '2026-08-01', 'Sample record'),
('Wheat', 'Rabi', 800.00, 28.00, '2026-10-10', 'Sample record');

INSERT INTO farmers (farmer_name, phone, location, land_acres) VALUES
('Ramesh Kumar', '9876543210', 'Mysuru', 3.50),
('Suresh Gowda', '9123456780', 'Mandya', 5.00);

INSERT INTO sales (crop_id, buyer_name, quantity_kg, amount, sale_date) VALUES
(1, 'Green Market', 100.00, 3200.00, '2026-10-20');