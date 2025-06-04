 <?php
// Database connection (assuming a db_config.php or similar)
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "EmployeeDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch departments for the dropdown
$departments_result = $conn->query("SELECT dept_id, dept_name FROM Department ORDER BY dept_name");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Employee</title>
</head>
<body>
    <h2>Add New Employee</h2>
    <form method="POST" action="process_employee.php">
 Name: <input type="text" name="emp_name" required><br><br>
        Salary: <input type="number" step="0.01" name="emp_salary" required><br><br>
        Department:
        <select name="emp_dept_id" required>
            <option value="">Select Department</option>
            <?php
            if ($departments_result->num_rows > 0) {
                while ($row = $departments_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['dept_id']) . "'>" . htmlspecialchars($row['dept_name']) . "</option>";
                }
            }
            ?>
        </select><br><br>
        <input type="submit" value="Add Employee">
    </form>
</body>
</html>

<?php
$conn->close();
?>