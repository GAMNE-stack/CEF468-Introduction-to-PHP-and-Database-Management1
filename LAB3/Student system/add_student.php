 <!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
</head>
<body>
    <h2>Add New Student</h2>
    <form method="POST" action="insert_student.php">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Phone Number: <input type="text" name="phone_number"><br><br>
        <input type="submit" value="Add Student">
    </form>
    <br>
    <a href="view_students.php">View Students</a>
</body>
</html>