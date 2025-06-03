 <?php
$conn = new mysqli('localhost', 'root', '', 'LibrarySystemDB');
$query = "SELECT b.book_title, a.name AS author, b.genre, b.price 
          FROM Books b INNER JOIN Authors a ON b.author_id = a.author_id";
$result = $conn->query($query);

echo "<table border='1'><tr><th>Title</th><th>Author</th><th>Genre</th><th>Price</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . htmlspecialchars($row['book_title']) . "</td><td>" .
         htmlspecialchars($row['author']) . "</td><td>" .
         htmlspecialchars($row['genre']) . "</td><td>{$row['price']}</td></tr>";
}
echo "</table>";
?>