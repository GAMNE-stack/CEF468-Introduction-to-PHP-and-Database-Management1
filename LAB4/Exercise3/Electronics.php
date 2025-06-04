 <?php
require_once 'Discountable.php';

class Electronics implements Discountable {
    // Properties
    public $name;
    public $price;
    public $warranty_months;

    // Constructor
    public function __construct($name, $price, $warranty) {
        $this->name = $name;
        $this->price = $price;
        $this->warranty_months = $warranty;
    }

    // Implement Discountable interface differently
    public function getDiscount() {
        // 15% discount for items with >1 year warranty
        if ($this->warranty_months > 12) {
            return $this->price * 0.85;
        }
        return $this->price;
    }
}
?>