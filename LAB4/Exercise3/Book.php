 <?php
require_once 'Discountable.php';

class Book implements Discountable {
    // Properties
    public $title;
    public $price;
    public $author;
    public $publication_year;

    // Constructor
    public function __construct($title, $price, $author, $year) {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->publication_year = $year;
    }

    // Implement Discountable interface
    public function getDiscount() {
        // Apply 10% discount for books older than 20 years
        if ((date('Y') - $this->publication_year) > 20) {
            return $this->price * 0.9;
        }
        return $this->price;
    }
}
