 <?php include 'auth_check.php'; include 'db_setup.php';

$result = $conn->query("SELECT * FROM Books");
echo "<table border='1'>
<tr><th>ID</th><th>Title</th><th>Author</th><th>Price</th><th>Genre</th><th>Year</th><th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['book_id']}</td>
        <td>" . htmlspecialchars($row['title']) . "</td>
        <td>" . htmlspecialchars($row['author']) . "</td>
        <td>{$row['price']}</td>
        <td>" . htmlspecialchars($row['genre']) . "</td>
        <td>{$row['year']}</td>
        <td>
            <a href='edit_book.php?id={$row['book_id']}'>Edit</a> |
            <a href='delete_book.php?id={$row['book_id']}' onclick='return confirm(\"Delete?\")'>Delete</a>
        </td>
    </tr>";
}
echo "</table>";
?>