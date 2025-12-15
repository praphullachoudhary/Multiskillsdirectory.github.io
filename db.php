<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Default XAMPP password is empty
$dbname = "village_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>