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
        .nav-item:nth-child(6) .nav-link{
                color: white;
        }
        .nav-item:nth-child(7) .nav-link{
                color: var(--gold-yellow);
        }
    </style>
</head>
<body>

<?php
include ("register_validation.php");


session_start();

$register_validator = new RegisterValidator();


?>
    <header class="header">
        <nav class="nav row" id="nav">
            <h1 class="header-title">LaTulipe</h1>

            <a href="javascript:void(0);" onclick="displayMenu()" class="menu-mobile" id="menu-mobile">
                <i class="fa-solid fa-bars" ></i>
            </a>
            <ul class="nav-list row" id="nav-list">
                <li class="nav-item"><a href="javascript:void(0);" onclick="removeMenu()" class="nav-link"><i class="fa-solid fa-xmark"></i></a></li>
                <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="delivery.html" class="nav-link">Delivery</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
                <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="booknow.php" class="nav-link btn">Book now</a></li>
            </ul>
        </nav>

        <div class="login-content">
            <div class="login-container">

                <div class="login-details">
                    <h1>Register</h1>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" > 
                    <input type="name" name="name" id="name" placeholder="Name" style="<?php echo $register_validator->getNameError(); ?>">
                    <input type="surname" name="surname" id="surname" placeholder="Surname"  style="<?php echo $register_validator->getSurnameError(); ?>">
                    <input type="number" name="number" id="number" placeholder="Phone number"  style="<?php echo $register_validator->getNumberError(); ?>">
                    <input type="email" name="email" id="email" placeholder="Email"  style="<?php echo $register_validator->getEmailError(); ?>">
                    <input type="password" name="password1" id="password1" placeholder="Password"  style="<?php echo $register_validator->getPasswordError(); ?>">
                    <input type="password" name="password2" id="password2" placeholder="Confirm Password"  style="<?php echo $register_validator->getPassMatchError(); ?>">

                        <input type="submit" id="sign" name="sign" class="btn" value="Sign up">
                        <!--<button type="submit" id="sign" name="sign" class="btn">Sign Up</button>-->
                        <p id="errorMsg" name="errorMsg"><?php echo $register_validator->getPassErr(); ?></p> 
                    </form>

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