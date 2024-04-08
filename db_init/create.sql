USE php_demo; 

CREATE TABLE users(
	id INT PRIMARY KEY AUTO_INCREMENT, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    email VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(245) NOT NULL,
    isAdmin BOOL DEFAULT 0,
    created_at DATETIME DEFAULT NOW()
); 

CREATE TABLE books (
	id INT PRIMARY KEY AUTO_INCREMENT, 
    title VARCHAR(80) NOT NULL UNIQUE, 
    author VARCHAR(80) NOT NULL,
    pages INT DEFAULT 0,
    description TEXT NOT NULL, 
    image LONGBLOB,
    owner_id INT NOT NUll,
    created_at DATETIME DEFAULT NOW(),
    CONSTRAINT fk_books_users 
    FOREIGN KEY (owner_id)
    REFERENCES users(id)
);