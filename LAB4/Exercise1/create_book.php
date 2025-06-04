 <?php
require_once 'Book.php';

$book = new Book("1984", "George Orwell", 1949, "Dystopian", 15.99);
$book->displayBookInfo();
?>