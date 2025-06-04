 <?php
$conn = new mysqli("localhost", "root", "", "LibraryDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$book_id = $_GET['id'];
$sql = "DELETE FROM Books WHERE book_id = $book_id";

if ($conn->query($sql) === TRUE) {
    echo "Book deleted successfully.";
} else {
    echo "Error deleting book: " . $conn->error;
}
$conn->close();
?>
<a href="read_books.php">View All Books</a>