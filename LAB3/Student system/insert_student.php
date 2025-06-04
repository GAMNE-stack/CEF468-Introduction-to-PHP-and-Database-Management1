 <?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "StudentDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['email'])) {
        die("Error: Name and Email are required.");
    }
    // Basic email validation
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number']; // Optional

    $stmt = $conn->prepare("INSERT INTO Students (name, email, phone_number) VALUES (?, ?, ?)");
 $stmt->bind_param("sss", $name, $email, $phone_number);

    if ($stmt->execute()) {
        echo "New student added successfully!<br>";
        echo "<a href='add_student.php'>Add Another Student</a><br>";
        echo "<a href='view_students.php'>View Students</a>";
    } else {
        // Check for duplicate email error (MySQL error code 1062)
        if ($conn->errno == 1062) {
            echo "Error: This email address is already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>