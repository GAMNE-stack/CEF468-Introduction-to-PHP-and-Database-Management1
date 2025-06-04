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

// Fetch employee data with department name using INNER JOIN
$sql = "SELECT e.emp_id, e.emp_name, e.emp_salary, d.dept_name, d.dept_location
        FROM Employee e
        INNER JOIN Department d ON e.emp_dept_id = d.dept_id
        ORDER BY e.emp_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employees</title>
    <style>
<style>
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Salary</th><th>Department</th><th>Dept. Location</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['emp_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['emp_name']) . "</td>";
            echo "<td>$" . htmlspecialchars(number_format($row['emp_salary'], 2)) . "</td>";
            echo "<td>" . htmlspecialchars($row['dept_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dept_location']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found.";
    }
    ?>
    <br>
    <a href="add_employee.php">Add New Employee</a>
</body>
</html>

<?php
$conn->close();
?>