 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Books List</h2>
        <table>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "LibraryDB");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM Books";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['book_id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['author']}</td>
                            <td>{$row['publication_year']}</td>
                            <td>{$row['genre']}</td>
                            <td>{$row['price']}</td>
                            <td>
                                <a href='update_book.php?id={$row['book_id']}'>Edit</a>
                                <a href='delete_book.php?id={$row['book_id']}'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No books found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>