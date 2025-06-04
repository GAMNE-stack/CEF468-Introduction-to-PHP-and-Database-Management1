 <?php
class Product {
    // Properties
    public $product_name;
    public $product_price;

    // Constructor
    public function __construct($name, $price) {
        $this->product_name = $name;
        $this->product_price = $price;
    }

    // Method to display product information
    public function displayProduct() {
        echo "Product Name: " . $this->product_name . "<br>";
        echo "Product Price: $" . $this->product_price . "<br>";
    }
}
?>