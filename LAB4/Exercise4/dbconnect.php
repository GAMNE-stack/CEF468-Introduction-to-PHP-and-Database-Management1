 <?php
// Database connection
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

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS LibraryDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select database
$conn->select_db($dbname);
// Create Books table
$sql = "CREATE TABLE IF NOT EXISTS Books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publication_year INT,
    genre VARCHAR(100),
    price FLOAT,
    is_ebook BOOLEAN DEFAULT FALSE,
    file_format VARCHAR(20),
    is_borrowed BOOLEAN DEFAULT FALSE,
    borrowed_by INT
)";

if ($conn->query($sql) === TRUE) {
    echo "Books table created successfully<br>";
} else {
    echo "Error creating Books table: " . $conn->error;
}

// Create Members table
$sql = "CREATE TABLE IF NOT EXISTS Members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    membership_date DATE
)";
if ($conn->query($sql) === TRUE) {
    echo "Members table created successfully<br>";
} else {
    echo "Error creating Members table: " . $conn->error;
}

// Create BookLoans table (for tracking loans)
$sql = "CREATE TABLE IF NOT EXISTS BookLoans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    member_id INT,
    loan_date DATE,
    return_date DATE,
    FOREIGN KEY (book_id) REFERENCES Books(book_id),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "BookLoans table created successfully<br>";
} else {
    echo "Error creating BookLoans table: " . $conn->error;
}

$conn->close();
?>