<?php
$host = 'localhost';
$db   = 'challenges';
$user = 'karim';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Handling the search-by-name functionality
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "SELECT id, first_name, last_name FROM users WHERE first_name LIKE '%$name%' OR last_name LIKE '%$name%'";
    
    try {
        $stmt = $pdo->query($sql);

        echo "<h3>Search Results:</h3>";
        while ($row = $stmt->fetch()) {
            echo "ID: " . $row['id'] . " - First Name: " . $row['first_name'] . " - Last Name: " . $row['last_name'] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Search by Name - SQL Injection Challenge 3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Search by Name</h2>
    <form action="search_by_name.php" method="GET">
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" value="Search">
    </form>

    <h2>Enter Flag</h2>
    <form action="validate_flag.php" method="POST">
        <input type="text" id="flag" name="flag"><br><br>
        <input type="submit" value="Submit Flag">
    </form>
</body>
</html>
