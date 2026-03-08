INSERT INTO login_table (user_name, user_email, login_password, user_role, user_status)
VALUES (
    'Admin',
    'admin@gmail.com',
    '$2y$10$uLK5ui74R8A7lkKpQzpcvuhALMBhqHmC1Mo94kt9LKlSzh/sJxftG',
    'Admin',
    '1'
);

DELETE FROM login_table WHERE user_id=10;

DROP TABLE	login_table;

CREATE TABLE login_table (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(150) UNIQUE NOT NULL,
    login_password VARCHAR(255) NOT NULL,
    user_role ENUM('Admin','Staff','User') DEFAULT 'User',
    user_status TINYINT(1) DEFAULT 1,
    reset_token VARCHAR(255) NULL,
    reset_token_expiry DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE staff_table (
	staff_id INT AUTO_INCREMENT PRIMARY KEY,
    staff_code VARCHAR(50) UNIQUE NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100),
    last_name VARCHAR(100) NOT NULL,
    nic VARCHAR(20) UNIQUE NOT NULL,
    gender ENUM('Male', 'Female', 'Other'),
    date_of_birth DATE,
    contact_number VARCHAR(15),
    address VARCHAR(100),
    role_id INT,
    employement_type ENUM('Full-time', 'Part-time', 'On Contract'),
    date_joined DATE,
    staff_status VARCHAR(20) DEFAULT 'Active',
    salary DECIMAL(10,2),
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    system_role VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (role_id) REFERENCES roleS(role_id)
);

CREATE TABLE roles (
	role_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE member_table (
	member_id INT AUTO_INCREMENT PRIMARY KEY,
    member_code VARCHAR(50) UNIQUE NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100),
    last_name VARCHAR(100) NOT NULL,
    nic VARCHAR(20) UNIQUE NOT NULL,
    gender ENUM('Male', 'Female', 'Other'),
    date_of_birth DATE,
    contact_number VARCHAR(15),
    address VARCHAR(100),
    member_status VARCHAR(20) DEFAULT 'Active',
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE user_tbl;

CREATE TABLE user_table (
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    nic VARCHAR(15),
    user_role VARCHAR(255),
    user_status VARCHAR(20) DEFAULT 'Active',
    password VARCHAR(255) NOT NULL,
    reset_token DATETIME,
    reset_token_expiry TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);