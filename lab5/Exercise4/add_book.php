 <
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add a New Book</h2>
        <form method="POST" action="process_create.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
            <label for="publication_year">Publication Year:</label>
            <input type="number" id="publication_year" name="publication_year" required>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
            <input type="submit" value="Add Book">
        </form>
    </div>
</body>
</html>