 <?php
require_once 'Book.php';
require_once 'Ebook.php';
require_once 'Member.php';

// Initialize sample data
$books = [
    new Book("The Great Gatsby", "F. Scott Fitzgerald", 10.99, 1925, "Fiction"),
    new Book("To Kill a Mockingbird", "Harper Lee", 7.99, 1960, "Fiction"),
    new Ebook("Clean Code", "Robert C. Martin", 29.99, 2008, "Programming", "PDF")
];

$members = [
    new Member(1, "John Doe", "john@example.com"),
    new Member(2, "Jane Smith", "jane@example.com")
];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookIndex = $_POST['book_index'] ?? null;
    $memberId = $_POST['member_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($bookIndex !== null && $memberId !== null && $action !== null) {
        $book = $books[$bookIndex];
        $member = $members[array_search($memberId, array_column($members, 'memberId'))];

        if ($action === 'borrow') {
            $result = $member->borrowBook($book);
            $message = $result ? "Book borrowed successfully!" : "Book is already borrowed!";
        } elseif ($action === 'return') {
            $result = $member->returnBook($book);
            $message = $result ? "Book returned successfully!" : "This member didn't borrow this book!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .book, .member { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .available { color: green; }
        .borrowed { color: red; }
        form { margin-top: 10px; }
        select, button { padding: 5px; margin-right: 10px; }
        .message { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background-color: #dff0d8; color: #3c763d; }
        .error { background-color: #f2dede; color: #a94442; }
    </style>
</head>
<body>
    <h1>Library System</h1>

    <?php if (isset($message)): ?>
        <div class="message <?= $result ? 'success' : 'error' ?>"><?= $message ?></div>
    <?php endif; ?>

    <h2>Books</h2>
    <?php foreach ($books as $index => $book): ?>
        <div class="book">
            <?php $book->displayInfo(); ?>
            <form method="post">
                <input type="hidden" name="book_index" value="<?= $index ?>">
                <select name="member_id">
                    <option value="">Select member</option>
                    <?php foreach ($members as $member): ?>
                        <option value="<?= $member->memberId ?>"><?= $member->name ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="action" value="borrow">Borrow</button>
                <button type="submit" name="action" value="return">Return</button>
            </form>
        </div>
    <?php endforeach; ?>

    <h2>Members</h2>
    <?php foreach ($members as $member): ?>
        <div class="member">
            <?php $member->displayInfo(); ?>
        </div>
    <?php endforeach; ?>
</body>
</html>