<?php
include  ("login_validation.php");

class RegisterValidator extends Validator {
    private $name_pattern = "/^([a-zA-Z]){2,30}$/";
    private $surname_pattern = "/^([a-zA-Z]){2,30}$/";
    private $mobileno_pattern = "/^\d{8,}$/";
    private $name_error="";
    private $surname_error="";
    private $number_error="";
    private $passMatch_error="";
    private $passErr="";
    public function __construct() {
        $this->validate();
    }

    private function validateName($name) {
        if (empty($name)) {
            $this->name_error = "border-bottom: 1px solid red;";
            return false;
        } else {
            if (!preg_match($this->name_pattern, $name)) {
                $this->name_error = "border-bottom: 1px solid red;";
                return false;
            } else {
                return true;
            }
        }
    }

    private function validateSurname($surname) {
        if (empty($surname)) {
            $this->surname_error = "border-bottom: 1px solid red;";
            return false;
        } else {
            if (!preg_match($this->surname_pattern, $surname)) {
                $this->surname_error = "border-bottom: 1px solid red;";
                return false;
            } else {
                return true;
            }
        }
    }

    private function validateMobileNumber($number) {
        if (empty($number)) {
            $this->number_error = "border-bottom: 1px solid red;";
            return false;
        } else {
            if (!preg_match($this->mobileno_pattern, $number)) {
                $this->number_error = "border-bottom: 1px solid red;";
                return false;
            } else {
                return true;
            }
        }
    }
    
    private function validatePasswordMatch($password1, $password2) {
        if (empty($password2)) {
            $this->passMatch_error = "border-bottom: 1px solid red;";
            return false;
        } else {
            if (!preg_match($this->password_pattern, $password2)) {
                $this->passMatch_error = "border-bottom: 1px solid red;";
                return false;
            } else if ($password1 !== $password2) {
            $this->passMatch_error = "border-bottom: 1px solid red;";
            $this->passErr="Password should be the same";
            return false;
        } else {
            return true;
        }
    }}
    
    
    private function validate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $this->input_data($_POST["name"]);
            $surname = $this->input_data($_POST["surname"]);
            $email = $this->input_data($_POST["email"]);
            $number = $this->input_data($_POST["number"]);
            $password1 = $this->input_data($_POST["password1"]);
            $password2 = $this->input_data($_POST["password2"]);
            $this->validateEmail($email);
            $this->validateName($name);
            $this->validateSurname($surname);
            $this->validateMobileNumber($number);
            $this->validatePassword($password1);
            $this->validatePasswordMatch($password1, $password2);

            if ($this->validateName($name) && $this->validateSurname($surname)&& $this->validateEmail($email) && $this->validateMobileNumber($number)
             && $this->validatePassword($password1)&&  $this-> validatePasswordMatch($password1, $password2)) {
                // Vendosni emrin e faqes së loginit në këtë variabël
                $login_page = "login.php";
                // Kalimi në faqen e loginit
                header("Location: $login_page");
                exit();
            }
        }
    }
    
    public function getNameError() {
        return $this->name_error;
    }
    public function getSurnameError() {
        return $this->surname_error;
    }
    public function getNumberError() {
        return $this->number_error;
    }
    public function getPassMatchError() {
        return $this->passMatch_error;
    }
    public function getPassErr() {
        return $this->passErr;
    }


}

?>