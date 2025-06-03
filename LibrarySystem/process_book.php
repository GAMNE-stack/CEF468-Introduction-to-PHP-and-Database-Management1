 <?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "LibrarySystemDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make sure form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check if all expected keys exist in $_POST
    if (isset($_POST['book_title'], $_POST['author_id'], $_POST['genre'], $_POST['price'])) {

        $title = trim($_POST['book_title']);
        $author_id = intval($_POST['author_id']);
        $genre = trim($_POST['genre']);
        $price = floatval($_POST['price']);

        // Validate inputs
        if (!empty($title) && $author_id > 0 && !empty($genre) && $price > 0) {
            $stmt = $conn->prepare("INSERT INTO Books (book_title, author_id, genre, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sisd", $title, $author_id, $genre, $price);
 if ($stmt->execute()) {
                echo "✅ Book added successfully!";
            } else {
                echo "❌ Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "❌ Invalid form data. Please fill all fields correctly.";
        }

    } else {
        echo "❌ Some form fields are missing.";
    }

} else {
    echo "⚠ This script should only run after submitting the form.";
}

$conn->close();
?>