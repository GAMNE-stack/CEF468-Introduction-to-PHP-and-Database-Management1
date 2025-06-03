 <?php
$conn = new mysqli('localhost', 'root', '', 'WebAppDB');
$result = $conn->query("SELECT * FROM Users");
echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>" . htmlspecialchars($row['name']) . "</td><td>" .
         htmlspecialchars($row['email']) . "</td><td>{$row['age']}</td></tr>";
}
echo "</table>";
$conn->close();
?>