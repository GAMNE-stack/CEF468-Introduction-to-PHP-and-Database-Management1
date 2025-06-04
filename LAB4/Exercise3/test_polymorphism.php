 <?php
require_once 'Book.php';
require_once 'Electronics.php';

// Create objects
$book = new Book("1984", 12.99, "George Orwell", 1949);
$laptop = new Electronics("Laptop", 899.99, 24);

// Demonstrate polymorphism
$products = [$book, $laptop];

foreach ($products as $product) {
    echo "<h2>" . (isset($product->title) ? $product->title : $product->name) . "</h2>";
    echo "Original Price: $" . $product->price . "<br>";
    echo "Discounted Price: $" . $product->getDiscount() . "<br><br>";
}
?>