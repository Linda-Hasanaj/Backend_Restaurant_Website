<?php
class Validator {
    private $email_pattern = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
    protected $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
    protected $email_error = "";
    protected $password_error = "";
    private $message = "";

    public function __construct() {

        $this->validate();
    }

    protected function input_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    protected function validateEmail($email) {
        if (empty($email)) {
            $this->email_error = "border-bottom: 1px solid red;";
            return false;
        } else {
            if (!preg_match($this->email_pattern, $email)) {
                $this->email_error = "border-bottom: 1px solid red;";
                $this->message = "Incorrect email or password";
                return false;
            } else {
                return true;
            }
        }
    }

    protected function validatePassword($password) {
        if (empty($password)) {
            $this->password_error = "border-bottom: 1px solid red;";
            return false;
        } else {
            if (!preg_match($this->password_pattern, $password)) {
                $this->password_error = "border-bottom: 1px solid red;";
                $this->message = "Incorrect email or password";
                return false;
            } else {
                return true;
            }
        }
    }
    private function validate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $this->input_data($_POST["email"]);
            $password = $this->input_data($_POST["password"]);
            $this->validateEmail($email);
            $this->validatePassword($password);

            if ($this->validateEmail($email) &&  $this->validatePassword($password)) {

                // Vendosni emrin e faqes së loginit në këtë variabël
                $index_page = "index.php";
                // Kalimi në faqen e loginit
                header("Location: $index_page");
                exit();
            }
        }
    }



    public function getMessage() {
        return $this->message;
    }

    public function getEmailError() {
        return $this->email_error;
    }

    public function getPasswordError() {
        return $this->password_error;
    }
}

?>

