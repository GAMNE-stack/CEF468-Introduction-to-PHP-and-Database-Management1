 <?php
require_once 'Loanable.php';
require_once 'Discountable.php';

class Book implements Loanable, Discountable {
    public $title;
    public $author;
    public $price;        // Will be stored as float
    public $publication_year;
    public $genre;
    public $isBorrowed = false;
    public $borrowedBy = null;

    public function __construct($title, $author, $price, $year, $genre) {
        $this->title = $title;
        $this->author = $author;
        $this->price = (float)$price;  // Explicitly cast to float
        $this->publication_year = (int)$year;
        $this->genre = $genre;
    }

    // Implement Loanable interface
    public function borrowBook($memberId) {
        if (!$this->isBorrowed) {
            $this->isBorrowed = true;
            $this->borrowedBy = $memberId;
            return true;
        }
        return false;
    }

    public function returnBook() {
        if ($this->isBorrowed) {
            $this->isBorrowed = false;
            $this->borrowedBy = null;
            return true;
        }
        return false;
    }

    // Implement Discountable interface
    public function getDiscount() {
        if ((date('Y') - $this->publication_year) > 20) {
            return $this->price * 0.9; // 10% discount
        }
        return $this->price;
    }

    public function displayInfo() {
        echo "<h3>{$this->title}</h3>";
        echo "Author: {$this->author}<br>";
        echo "Price: \$" . number_format($this->price, 2);
        echo " (Discounted: \$" . number_format($this->getDiscount(), 2) . ")<br>";
        echo "Year: {$this->publication_year}<br>";
        echo "Genre: {$this->genre}<br>";
        echo "Status: " . ($this->isBorrowed ? 
             "Borrowed by member #{$this->borrowedBy}" : "Available") . "<br>";
    }
}
?>