 <?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "LibraryDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error array
$errors = [];

// Retrieve and trim input values
$title = trim($_POST['title']);
$author = trim($_POST['author']);
$publication_year = trim($_POST['publication_year']);
$genre = trim($_POST['genre']);
$price = trim($_POST['price']);

// Validate input fields
if (empty($title)) {
    $errors[] = "Title is required.";
}
if (empty($author)) {
    $errors[] = "Author is required.";
}
if (empty($publication_year) || !is_numeric($publication_year)) {
    $errors[] = "Publication year must be a valid number.";
}
if (empty($genre)) {
    $errors[] = "Genre is required.";
}
if (empty($price) || !is_numeric($price)) {
    $errors[] = "Price must be a valid number.";
}

// If no errors, proceed to insert into database
if (empty($errors)) {
    $sql = "INSERT INTO Books (title, author,  genre, price) VALUES (?, ?, ?, ?)";
    
    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $title, $author, $publication_year, $genre, $price);

    if ($stmt->execute()) {
        echo "New book added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}

$conn->close();
?>
<a href="read_books.php">View All Books</a>