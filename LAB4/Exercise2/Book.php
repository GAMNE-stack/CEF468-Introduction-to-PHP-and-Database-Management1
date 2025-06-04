 <?php
require_once 'Product.php';

class Book extends Product {
    // Additional properties specific to Book
    public $author;
    public $publication_year;
    public $genre;

    // Constructor
    public function __construct($name, $price, $author, $year, $genre) {
        parent::__construct($name, $price);
        $this->author = $author;
        $this->publication_year = $year;
        $this->genre = $genre;
    }

    // Override displayProduct method
    public function displayProduct() {
        parent::displayProduct();
        echo "Author: " . $this->author . "<br>";
        echo "Publication Year: " . $this->publication_year . "<br>";
        echo "Genre: " . $this->genre . "<br>";
    }
}
?>