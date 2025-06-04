 <?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "LibraryDB";

$conn = new mysqli($host, $user, $pass);
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$conn->query("CREATE TABLE IF NOT EXISTS Books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    price FLOAT,
    genre VARCHAR(100),
    year INT
)");
?>