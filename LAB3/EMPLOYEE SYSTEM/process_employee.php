 <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "EmployeeDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    if (empty($_POST['emp_name']) || empty($_POST['emp_salary']) || empty($_POST['emp_dept_id'])) {
        die("Error: All fields are required.");
    }

    $emp_name = $_POST['emp_name'];
    $emp_salary = $_POST['emp_salary'];
    $emp_dept_id = $_POST['emp_dept_id'];

    // Basic validation for salary
    if (!is_numeric($emp_salary) || $emp_salary < 0) {
        die("Error: Invalid salary amount.");
    }
 }
    // Basic validation for department ID
    if (!filter_var($emp_dept_id, FILTER_VALIDATE_INT)) {
        die("Error: Invalid department ID.");
    }


    // Insert data into Employee table
    $stmt = $conn->prepare("INSERT INTO Employee (emp_name, emp_salary, emp_dept_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $emp_name, $emp_salary, $emp_dept_id);

    if ($stmt->execute()) {
        echo "New employee added successfully! <br>";
        echo "<a href='add_employee.php'>Add Another Employee</a><br>";
        echo "<a href='view_employees.php'>View Employees</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>