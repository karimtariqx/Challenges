<?php
session_start();
$host = 'localhost';
$db = 'challenges';
$user = 'karim';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function verifyPassword($pdo, $inputPassword) {
    $sql = "SELECT password FROM users WHERE username = '0xkimoz'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $userPassword = $stmt->fetchColumn();

    // Directly compare the input password with the database password
    return $inputPassword === $userPassword;
}

$passwordVerified = false;

if (isset($_POST['password'])) {
    $inputPassword = $_POST['password'];

    if (verifyPassword($pdo, $inputPassword)) {
        $passwordVerified = true;
    } else {
        echo "<p>Wrong answer. Please try again.</p>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT first_name, last_name FROM users WHERE id = '$id'"; 
    $stmt = $pdo->query($sql);
    echo "<h3>Search Results:</h3>";
    while ($row = $stmt->fetch()) {
        echo "First Name: " . $row['first_name'] . " - Last Name: " . $row['last_name'] . "<br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search by ID - SQL Injection Challenge 2</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Search by ID</h2>
    <form action="search_by_id.php" method="GET">
        <label for="id">Enter User ID:</label>
        <input type="text" id="id" name="id"><br><br>
        <input type="submit" value="Search">
    </form>

    <h2>can you get 0xKimoz's password?</h2>
    <form action="search_by_id.php" method="POST">
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Verify">
    </form>

    <?php
    if ($passwordVerified) {
        echo '<br><a href="search_by_name.php">Proceed to the Next Challenge</a>';
    }
    ?>
</body>
</html>
