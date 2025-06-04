 <?php
require_once 'Book.php';

class Ebook extends Book {
    // Additional property for Ebook
    public $fileFormat;

    // Constructor
    public function __construct($name, $price, $author, $year, $genre, $format) {
        parent::__construct($name, $price, $author, $year, $genre);
        $this->fileFormat = $format;
    }

    // Method specific to Ebook
    public function download() {
        return "Downloading " . $this->title . " in " . $this->fileFormat . " format...";
    }

    // Override getDiscount for Ebook (higher discount)
    public function getDiscount() {
        // Ebooks get 20% discount if older than 5 years
        if ((date('Y') - $this->publication_year) > 5) {
            return $this->product_price * 0.8; // 20% discount
        }
        return parent::getDiscount(); // Fall back to parent's discount
    }
 // Override displayBookInfo to include file format
    public function displayBookInfo() {
        parent::displayBookInfo();
        echo "Format: " . $this->fileFormat . "<br>";
    }
}
?>