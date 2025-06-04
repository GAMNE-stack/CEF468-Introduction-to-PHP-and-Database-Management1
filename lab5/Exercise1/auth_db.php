 <?php
// Database connection and setup script
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LibraryDB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Select database
    $conn->select_db($dbname);
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        google_id VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE (email)
    )";
    
    if ($conn->query($sql) === TRUE) {
        // Create books table
        $sql = "CREATE TABLE IF NOT EXISTS Books (
            book_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            publication_year INT(4),
            genre VARCHAR(100),
            price DECIMAL(10,2),
            added_by INT(6) UNSIGNED,
            FOREIGN KEY (added_by) REFERENCES users(id)
        )";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Error creating Books table: " . $conn->error;
        }
    } else {
        echo "Error creating users table: " . $conn->error;
    }
} else {
    echo "Error creating database: " . $conn->error;
}

echo "Database setup completed successfully";
?>