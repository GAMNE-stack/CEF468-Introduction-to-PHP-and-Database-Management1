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

$student_id = null;
$name = '';
$email = '';
$phone_number = '';

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    if (!filter_var($student_id, FILTER_VALIDATE_INT)) {
        die("Invalid student ID.");
    }

    $stmt = $conn->prepare("SELECT name, email, phone_number FROM Students WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
$stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
    } else {
        die("Student not found.");
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    if (empty($_POST['student_id']) || empty($_POST['name']) || empty($_POST['email'])) {
        die("Error: Student ID, Name, and Email are required for update.");
    }
     if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }
 $student_id_post = $_POST['student_id'];
    $name_post = $_POST['name'];
    $email_post = $_POST['email'];
    $phone_number_post = $_POST['phone_number'];

    if (!filter_var($student_id_post, FILTER_VALIDATE_INT)) {
        die("Invalid student ID for update.");
    }

    $stmt = $conn->prepare("UPDATE Students SET name = ?, email = ?, phone_number = ? WHERE student_id = ?");
    $stmt->bind_param("sssi", $name_post, $email_post, $phone_number_post, $student_id_post);

    if ($stmt->execute()) {
        echo "Student record updated successfully! <br>";
        echo "<a href='view_students.php'>View Students</a>";
        // To prevent re-submission and to show updated values if user stays on page:
        $student_id = $student_id_post; // Keep current ID
        $name = $name_post;
        $email = $email_post;
        $phone_number = $phone_number_post;
    } else {
         if ($conn->errno == 1062) { // Duplicate email
            echo "Error updating record: This email address is already registered by another student.";
     } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Record</h2>
    <?php if ($student_id): ?>
    <form method="POST" action="edit_student.php?student_id=<?php echo htmlspecialchars($student_id); ?>">
        <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>
        Phone Number: <input type="text" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>"><br><br>
        <input type="submit" value="Update Student">
    </form>
<?php else: ?>
        <p>No student selected for editing. Please select a student from the <a href="view_students.php">student list</a>.</p>
    <?php endif; ?>
    <br>
    <a href="view_students.php">Back to Student List</a>
</body>
</html>

<?php
$conn->close();
?>