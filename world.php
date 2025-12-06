<?php
$host = 'localhost';
$port = 3307;
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

//Get the country parameter from the URL
$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

//Determining which query to use
if($lookup === "cities") {
  $query = "SELECT cities.name, cities.district, cities.population
            FROM cities
            JOIN countries ON cities.country_code = countries.code
            WHERE cities.name LIKE :city";

  $stmt = $conn->prepare($query);
  $stmt->execute(['city' => "%$country%"]);
} else{
  $query = "SELECT * FROM countries WHERE name LIKE :country";

  $stmt = $conn->prepare($query);
$stmt->execute(['country' => "%$country%"]);
}

//Fetch results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Table output
if ($lookup == "cities") {
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['district']}</td>";
        echo "<td>{$row['population']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
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
}
?>
