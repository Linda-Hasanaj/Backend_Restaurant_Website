<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
    
<body>

<?php
session_start();

$email_pattern="/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
$email_error="";
$password_error="";
$emailvalid=false;
$passvalid=false;
$message="";
$passwords="";
$emails="";
$passwords="";


function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION['email'])&&isset($_SESSION['password2'])){
        $emails=$_SESSION['email'];
        $passwords=$_SESSION['password2'];
    }
    
    if(empty($_POST["email"])){
        $email_error = "border-bottom: 1px solid red;";
    } else {
        $email=input_data($_POST["email"]);
        if(!preg_match($email_pattern,$email) && $password!==$passwords){
            $message="Incorrect email or password";
            $email_error = "border-bottom: 1px solid red;";
        }else{
            $emailvalid=true;
        }
    }
    if(empty($_POST["password"])){
        $password_error = "border-bottom: 1px solid red;";
    } else {
        $password=input_data($_POST["password"]);
        if($password !== $passwords){
            $password_error = "border-bottom: 1px solid red;";
            $message="Incorrect email or password";
        }else{
            $passvalid=true;
        }
    }

    if ($emailvalid && $passvalid) {
        // Vendosni emrin e faqes së loginit në këtë variabël
        $index_page = "index.html";
        // Kalimi në faqen e loginit
        header("Location: $index_page");
        exit();
    }

}


?>
    <header class="header">
        <nav class="nav row" id="nav">
            <h1 class="header-title">LaTulipe</h1>

            <a href="javascript:void(0);" onclick="displayMenu()" class="menu-mobile" id="menu-mobile">
                <i class="fa-solid fa-bars" ></i>
            </a>
            <ul class="nav-list row" id="nav-list">
                <li class="nav-item"><a href="javascript:void(0);" onclick="removeMenu()" class="nav-link"><i class="fa-solid fa-xmark"></i></a></li>
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="delivery.php" class="nav-link">Delivery</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
                <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="booknow.php" class="nav-link btn">Book now</a></li>
            </ul>
        </nav>

        <div class="login-content">
            <div class="login-container">

                <div class="login-details">
                    <h1>Welcome Back</h1>
                    <p>Sign in with your email address and password</p>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="email" name="email" id="email" placeholder="Email" style="<?php echo $email_error; ?>">
                        <input type="password" name="password" id="password" placeholder="Password" style="<?php echo $email_error; ?>">
                        <a href="#" >Reset Password       <span style="color: red; text-decoration: none;" >    <?php echo $message; ?></span>  </a>
                        <input type="submit" id="sign" name="sign" class="btn" value="Log in">
                      <!---  <button id="sign" class="btn">Log In</button>-->
                    </form>

                    <p>Don't have an account? <a href="register.html" class="underline">Register</a></p>
                </div>
                <div class="login-photo">
                    
                </div>
            </div>
        </div>
    </header>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <p>40 Park Ave, Brooklyn, New York</p>
                    <p>1-800-111-2222</p>
                    <p>contact@example.com</p>
                    <div class="footer-socials">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-content">
                <h1>LaTulipe</h1>
            </div>
            <div class="footer-content">
                <p>Monday - Friday: 9AM - 9PM</p>
                <p>Saturday: 9AM - 11PM</p>
                <p>Sunday: 9AM - 11PM</p>
                <p>Happy Hours: 9AM - 12AM</p>
            </div>
        </div>

    </footer>

    <script src="javascript/index.js"></script>
</body>


</html>
