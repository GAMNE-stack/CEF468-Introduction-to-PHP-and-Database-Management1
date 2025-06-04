 <?php
require_once 'auth_check.php';
require_once 'db_setup.php';

// Get all books from database
$stmt = $conn->prepare("SELECT * FROM Books");
$stmt->execute();
$books = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .book-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .book-card { border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
        .actions { margin-top: 10px; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .welcome { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>!</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        
        <h3>Available Books</h3>
        <div class="book-list">
            <?php while ($book = $books->fetch_assoc()): ?>
                <div class="book-card">
                    <h4><?php echo htmlspecialchars($book['title']); ?></h4>
                    <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                    <p>Year: <?php echo htmlspecialchars($book['publication_year']); ?></p>
                    <p>Genre: <?php echo htmlspecialchars($book['genre']); ?></p>
                    <p>Price: $<?php echo number_format($book['price'], 2); ?></p>
                    
                    <div class="actions">
                        <a href="view_book.php?id=<?php echo $book['book_id']; ?>" class="btn btn-primary">View</a>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <a href="edit_book.php?id=<?php echo $book['book_id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_book.php?id=<?php echo $book['book_id']; ?>" class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
            <div style="margin-top: 30px;">
                <a href="add_book.php" class="btn btn-primary">Add New Book</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>