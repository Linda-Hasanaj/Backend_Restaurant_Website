<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("register_validation.php");
include("db_connect.php");

session_start();

$register_validator = new RegisterValidator();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $_SESSION['registration_data'] = array(
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'email' => $_POST['email'],
        'number' => $_POST['number']
    );

    if ($register_validator->validateInput($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['number'], $_POST['password1'], $_POST['password2'])) {
        $register_validator->insertUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['number'], $_POST['password1']);
        
        // Redirect to index.php
        header("Location: index.php");
        exit;
    } else {
        echo "Validation failed. Please check your input.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <style>
        .nav-item:nth-child(6) .nav-link {
            color: white;
        }
        .nav-item:nth-child(7) .nav-link {
            color: var(--gold-yellow);
        }
    </style>
</head>
<body>

<header class="header">
    <nav class="nav row" id="nav">
        <h1 class="header-title">LaTulipe</h1>
        <a href="javascript:void(0);" onclick="displayMenu()" class="menu-mobile" id="menu-mobile">
            <i class="fa-solid fa-bars"></i>
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
                <h1>Register</h1>
                <form action="register.php" method="POST">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="text" name="surname" placeholder="Surname" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="number" placeholder="Phone Number" required>
                    <input type="password" name="password1" placeholder="Password" required>
                    <input type="password" name="password2" placeholder="Confirm Password" required>
                    <button type="submit" name="register" class="btn">Sign Up</button>
                </form>
            </div>
            <div class="login-photo"></div>
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
