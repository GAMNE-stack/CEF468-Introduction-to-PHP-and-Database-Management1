 <?php
require_once 'Product.php';
require_once 'Book.php';

// Create a Product object
$product = new Product("Generic Product", 19.99);
echo "<h2>Product Information:</h2>";
$product->displayProduct();

// Create a Book object
$book = new Book("To Kill a Mockingbird", 7.99, "Harper Lee", 1960, "Fiction");
echo "<h2>Book Information:</h2>";
$book->displayProduct();
?>