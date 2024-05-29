<?php
require_once 'error_handler.php'; // Ensuring the custom error handler is included only once

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";
$port=3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    trigger_error("Lidhja me bazën e të dhënave dështoi: " . $conn->connect_error, E_USER_ERROR);
} else {
    // echo "Lidhja me bazën e të dhënave u realizua me sukses!";
}
?>
