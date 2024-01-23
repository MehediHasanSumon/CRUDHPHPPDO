<?php 
$dsn = 'mysql:host=localhost;dbname=pdo_project';
$dbuser = 'root';
$dbpass = '';

try {
 $conn = new PDO($dsn, $dbuser, $dbpass);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>