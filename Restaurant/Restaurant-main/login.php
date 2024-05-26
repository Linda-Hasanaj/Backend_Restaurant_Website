<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include("db_connect.php");
include("login_validation.php");



$login_validator = new LoginValidator();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($login_validator->validateInput($email, $password)) {
        $user = $login_validator->authenticateUser($email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: index.php");
            exit;
        } else {
            $login_error = $login_validator->getMessage();
        }
    } else {
        $login_error = $login_validator->getMessage();
    }
}
?>

<?php include("header.php"); ?>

<div class="login-content">
    <div class="login-container">
        <div class="login-details">
            <h1>Welcome Back</h1>
            <p>Sign in with your email address and password</p>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <a href="#">Reset Password <span style="color: red; text-decoration: none;"><?php echo isset($login_error) ? $login_error : ''; ?></span></a>
                <input type="submit" id="sign" name="sign" class="btn" value="Log in">
            </form>

            <p>Don't have an account? <a href="register.php" class="underline">Register</a></p>
        </div>
        <div class="login-photo"></div>
    </div>
</div>

<?php include("footer.php"); ?>

<script src="javascript/index.js"></script>
</body>
</html>
