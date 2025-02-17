<?php
// config.php
$host = 'localhost';   // Hostname
$dbname = 'news-site'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // Set the PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO attributes to handle errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, output the error message
    echo "Connection failed: " . $e->getMessage();
    die(); // Stop further execution
}
?>
