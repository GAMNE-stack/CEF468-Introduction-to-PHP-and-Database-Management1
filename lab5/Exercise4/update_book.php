 <?php
$conn = new mysqli("localhost", "root", "", "LibraryDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$book_id = $_GET['id'];
$result = $conn->query("SELECT * FROM Books WHERE book_id = $book_id");
$book = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Update Book ID: <?php echo $book_id; ?></h2>
        <form method="POST" action="process_update.php">
            <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required>
            <label for="publication_year">Publication Year:</label>
            <input type="number" id="publication_year" name="publication_year" value="<?php echo $book['publication_year']; ?>" required>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="<?php echo $book['genre']; ?>" required>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $book['price']; ?>" required>
            <input type="submit" value="Update Book">
        </form>
    </div>
</body>
</html>