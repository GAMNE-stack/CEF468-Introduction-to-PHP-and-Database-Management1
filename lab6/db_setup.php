 <?php
/**
 * Database Configuration and Setup Script
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'LibraryDB');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Establish database connection
 * @return mysqli Database connection object
 */
function db_connect() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8
    $conn->set_charset("utf8mb4");
    
    return $conn;
}

// Create database connection
$conn = db_connect();

/**
 * Setup database tables if they don't exist
 */
function setup_database_tables($conn) {
    // Users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'user') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        google_id VARCHAR(255) DEFAULT NULL
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating users table: " . $conn->error);
    }
    
    // Books table
    $sql = "CREATE TABLE IF NOT EXISTS books (
        book_id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        genre VARCHAR(100),
        year INT,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES users(user_id)
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating books table: " . $conn->error);
    }
    
    // Book loans table
    $sql = "CREATE TABLE IF NOT EXISTS book_loans (
        loan_id INT AUTO_INCREMENT PRIMARY KEY,
        book_id INT NOT NULL,
        user_id INT NOT NULL,
        loan_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        return_date TIMESTAMP NULL,
        FOREIGN KEY (book_id) REFERENCES books(book_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating book_loans table: " . $conn->error);
    }
}

// Call the setup function (optional - might want to run this separately)
// setup_database_tables($conn);

/**
 * Close database connection
 */
function db_close($conn) {
    $conn->close();
}

// Register shutdown function to close connection
register_shutdown_function(function() use ($conn) {
    db_close($conn);
});
?>