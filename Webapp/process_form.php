 <?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "WebAppDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only run this if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check if required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['age'])) {

        $name = trim($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $age = intval($_POST['age']);

        if (!empty($name) && $email && $age > 0) {
            $stmt = $conn->prepare("INSERT INTO Users (name, email, age) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $name, $email, $age);

            if ($stmt->execute()) {
                echo "✅ User added successfully!";
            } else {
                echo "❌ Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "❌ Invalid input.";
        }
    } else {
        echo "❌ Missing form fields.";
    }
} else {
    echo "⚠ Please submit the form.";
}

$conn->close();
?>