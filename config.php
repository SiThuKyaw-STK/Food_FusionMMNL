<?php
$host = 'localhost:3307';
$db = 'foodfusion';
$user = 'root'; // Default XAMPP MySQL username
$password = ''; // Default XAMPP MySQL password is empty
$charset = 'utf8mb4';

// Set the Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $user, $password, $options);
    echo "Connected to the database successfully!";
} catch (\PDOException $e) {
    // Handle connection error
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
