<?php
require_once 'error_handler.php'; // Ensure the custom error handler is included only once

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    trigger_error("Lidhja me bazën e të dhënave dështoi: " . $conn->connect_error, E_USER_ERROR);
} else {
    // Comment out or remove the success message to avoid stopping script execution
    // echo "Lidhja me bazën e të dhënave u realizua me sukses!";
}
?>
