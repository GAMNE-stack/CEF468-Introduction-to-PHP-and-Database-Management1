 <?php
class Member {
    public $memberId;
    public $name;
    public $email;
    public $borrowedBooks = [];
    public $membershipDate; // Optional, if you want to keep it

    // Constructor with 3 required parameters
    public function __construct($id, $name, $email, $membershipDate = null) {
        $this->memberId = $id;
        $this->name = $name;
        $this->email = $email;
        $this->membershipDate = $membershipDate ?? date('Y-m-d'); // Default to today
    }

    public function borrowBook($book) {
        if ($book->borrowBook($this->memberId)) {
            $this->borrowedBooks[] = $book;
            return true;
        }
        return false;
    }

    public function returnBook($book) {
        if ($book->returnBook()) {
            $index = array_search($book, $this->borrowedBooks);
            if ($index !== false) {
                unset($this->borrowedBooks[$index]);
                return true;
            }
        }
        return false;
    }

    public function displayInfo() {
        echo "<h3>Member: {$this->name}</h3>";
        echo "Email: {$this->email}<br>";
        echo "Member since: {$this->membershipDate}<br>";
        echo "Borrowed books: " . count($this->borrowedBooks) . "<br>";
    }
}
?>