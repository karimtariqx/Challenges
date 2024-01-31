
<!DOCTYPE html>
<html>
<head>
    <title>Login - SQL Injection Challenge 1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Login Page</h2>
    <form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>

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

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'"; //
$stmt = $pdo->query($sql);

if ($stmt->fetch()) {
    header("Location: search_by_id.php"); // Redirect to the next challenge
} else {
    echo "Invalid login!";
}
} else {
    //echo "Form fields are not set properly.";
}
?>

