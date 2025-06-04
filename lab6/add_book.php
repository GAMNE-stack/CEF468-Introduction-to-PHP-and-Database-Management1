 <?php
require_once 'auth_check.php';
require_once 'db_setup.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO Books (title, author, price, genre, year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $title, $author, $price, $genre, $year);
    
    if ($stmt->execute()) {
        header("Location: view_books.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>
    <h1>Add New Book</h1>
    <form method="POST" action="add_book.php">
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Price: <input type="number" step="0.01" name="price" required><br>
        Genre: <input type="text" name="genre" required><br>
        Year: <input type="number" name="year" required><br>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>