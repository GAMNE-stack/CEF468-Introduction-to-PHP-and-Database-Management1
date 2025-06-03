 <?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "LibrarySystemDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch authors for the dropdown
$authors = $conn->query("SELECT author_id, name FROM Authors");

if (!$authors) {
    die("Error fetching authors: " . $conn->error);
}
?>

<!-- HTML Form to Add Book -->
<h2>Add a New Book</h2>
<form method="POST" action="process_book.php">
    Title: <input type="text" name="book_title" required><br><br>

    Author:
    <select name="author_id" required>
        <option value="">-- Select Author --</option>
        <?php while ($row = $authors->fetch_assoc()): ?>
            <option value="<?= $row['JK ROWLINGS'] ?>"><?= htmlspecialchars($row['JK ROWLINGS']) ?></option>
        <?php endwhile; ?>
</select><br><br>

    Genre: <input type="text" name="genre" required><br><br>
    Price: <input type="number" name="price" step="0.01" required><br><br>

    <input type="submit" value="Add Book">
</form>

<?php $conn->close(); ?>