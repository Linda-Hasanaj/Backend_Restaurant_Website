<?php
include("db_connect.php");

class LoginValidator {
    private $emailError = "";
    private $passwordError = "";
    private $message = "";

    public function getEmailError() { return $this->emailError; }
    public function getPasswordError() { return $this->passwordError; }
    public function getMessage() { return $this->message; }

    public function validateInput($email, $password) {
        $valid = true;

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $this->emailError = "border: 1px solid red;"; 
            $valid = false; 
        }

        if (empty($password)) { 
            $this->passwordError = "border: 1px solid red;"; 
            $valid = false; 
        }

        return $valid;
    }
    public function authenticateUser($email, $password) {
        global $conn;
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            $this->message = "Invalid email or password.";
            return false;
        }
    }
}
?>
