Create database village_db;
use village_db;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'skilled') NOT NULL,
    age INT,
    place VARCHAR(100),
    skills VARCHAR(255), -- Stores comma separated skills
    rate_per_day DECIMAL(10,2),
    experience INT, -- In years
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);