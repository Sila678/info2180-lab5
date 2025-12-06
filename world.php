<?php
$host = 'localhost';
$port = 3307;
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

//Get the country parameter from the URL
$country = $_GET['country'] ?? '';

//Using prepared statement to avoid SQL injection
$query = "SELECT * FROM countries WHERE name LIKE :country";
$stmt = $conn->prepare($query);
$stmt->execute(['country' => "%$country%"]); // correct format

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo "<table border='1'>";
echo "<tr><th>Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";

foreach ($results as $row) {
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['continent']}</td>";
    echo "<td>{$row['independence_year']}</td>";
    echo "<td>{$row['head_of_state']}</td>";
    echo "</tr>";
}

echo "</table>";
?>
