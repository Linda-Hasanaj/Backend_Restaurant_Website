<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db_connect.php");

class RegisterValidator {
    private $nameError = "";
    private $surnameError = "";
    private $emailError = "";
    private $numberError = "";
    private $passwordError = "";
    private $passMatchError = "";
    private $passErr = "";

    public function getNameError() { return $this->nameError; }
    public function getSurnameError() { return $this->surnameError; }
    public function getEmailError() { return $this->emailError; }
    public function getNumberError() { return $this->numberError; }
    public function getPasswordError() { return $this->passwordError; }
    public function getPassMatchError() { return $this->passMatchError; }
    public function getPassErr() { return $this->passErr; }

    public function validateInput($name, $surname, $email, $number, $password1, $password2) {
        $valid = true;

        // Check if fields are empty
        if (empty($name)) { 
            $this->nameError = "border: 1px solid red;"; 
            $valid = false; 
            echo "Name is required.<br>";
        }
        if (empty($surname)) { 
            $this->surnameError = "border: 1px solid red;"; 
            $valid = false; 
            echo "Surname is required.<br>";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $this->emailError = "border: 1px solid red;"; 
            $valid = false; 
            echo "Valid email is required.<br>";
        }
        if (empty($number) || !preg_match("/^[0-9]{10,15}$/", $number)) { 
            $this->numberError = "border: 1px solid red;"; 
            $valid = false; 
            echo "Valid phone number is required.<br>";
        }
        if (empty($password1) || strlen($password1) < 6) { 
            $this->passwordError = "border: 1px solid red;"; 
            $valid = false; 
            echo "Password must be at least 6 characters long.<br>";
        }
        if ($password1 !== $password2) { 
            $this->passMatchError = "border: 1px solid red;"; 
            $valid = false; 
            echo "Passwords do not match.<br>";
        }

        return $valid;
    }

    public function insertUser($name, $surname, $email, $number, $password) {
        global $conn;
    
        try {
            // Prepare the SQL statement
            $sql = "INSERT INTO users (name, surname, email, number, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
    
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            // Bind parameters
            if (!$stmt->bind_param("sssss", $name, $surname, $email, $number, $hashed_password)) {
                throw new Exception("Binding parameters failed: " . $stmt->error);
            }
    
            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Execute statement failed: " . $stmt->error);
            }
    
            // Set the session user ID
            $_SESSION['user_id'] = $stmt->insert_id; // Assuming 'id' is the auto-increment field in your 'users' table
    
            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            // Log the error and display a generic message to the user
            error_log($e->getMessage());
            echo "Something went wrong. Please try again later.";
        }
    }
}
