 <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "StudentDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Validate student_id
    if (!filter_var($student_id, FILTER_VALIDATE_INT)) {
        die("Invalid student ID.");
    }

    $stmt = $conn->prepare("DELETE FROM Students WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Student record deleted successfully!<br>";
      } else {
            echo "No student found with that ID, or student already deleted.<br>";
        }
    } else {
        echo "Error deleting record: " . $stmt->error . "<br>";
    }
    $stmt->close();
} else {
    echo "No student ID specified for deletion.<br>";
}

$conn->close();

echo "<a href='view_students.php'>Back to Student List</a>";
?>