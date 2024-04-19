<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Checkout</title>
    <style>
        .nav-item:nth-child(4) .nav-link{
            color: white;
        }
        .contact-form {
            padding: 3em;
            background-color: var(--main-dark);
        }
        .hidden {
            display: none;
}

#successMessage p {
        margin: 0; /* Reset margin for paragraph inside success message */
        background-color: rgba(0, 0, 0, 0.6);
    text-align: center;
    height: 90vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-family: 'Crimson Text', serif;;
    font-size: 50px;
    }


    </style>
</head>
<body>

<?php

session_start();

if(isset($_SESSION['registration_data'])) {
    $registration_data = $_SESSION['registration_data'];

    $name_value = isset($registration_data['name']) ? $registration_data['name'] : '';
    $email_value = isset($registration_data['email']) ? $registration_data['email'] : '';
    $number_value = isset($registration_data['number']) ? $registration_data['number'] : '';
} else {
    $name_value = '';
    $email_value = '';
    $number_value = '';
}

$name_pattern = "/^[a-zA-Z]+(?:\s+[a-zA-Z]+)*$/";
$email_pattern="/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
$mobileno_pattern="/^\d{8,}$/";
$address_pattern="/^[a-zA-Z0-9\s]{1,50}$/";
$name_error =$email_error = $number_error= $address_error = "";

$name=$email=$number=$address="";
$namevalid=$emailvalid=$numbervalid=$addressvalid=false;

function capitalizeFirstLetter($string) {
    return preg_replace_callback(
        '/\b\w/i', 
        function($matches) {
            return strtoupper($matches[0]); // Bën shkronjën e parë të madhe
        },
        $string
    );
}

function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["namee"])){
        $name_error = "border-bottom: 1px solid red;";
    } else {
        $name = capitalizeFirstLetter(input_data($_POST["namee"]));
        if(!preg_match($name_pattern,$name)){
            $name_error = "border-bottom: 1px solid red;";
        }else{
            $namevalid=true;
        }
    }

    if(empty($_POST["address"])){
        $address_error = "border-bottom: 1px solid red;";
    } else {
        $address=input_data($_POST["address"]);
        if(!preg_match($address_pattern,$address)){
            $address_error = "border-bottom: 1px solid red;";
        }else{
            $addressvalid=true;
        }
    }

    if(empty($_POST["email"])){
        $email_error = "border-bottom: 1px solid red;";
    } else {
        $email=input_data($_POST["email"]);
        if(!preg_match($email_pattern,$email)){
            $email_error = "border-bottom: 1px solid red;";
        }else{
            $emailvalid=true;
        }
    }

    if (empty($_POST["number"])) {
        $number_error = "border-bottom: 1px solid red;";
    } else {
        $number = input_data($_POST["number"]);
        if (!preg_match($mobileno_pattern, $number)) {
            $number_error = "border-bottom: 1px solid red;";
        }else{
            $numbervalid=true;
        }
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


        <div class="headerContent">
            <aside  class="contact-form">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="namee" id="name" placeholder="Name" style="<?php echo $name_error; ?>" value="<?php echo $name_value; ?>">
<input type="email" name="email" id="email" placeholder="Email" style="<?php echo $email_error; ?>" value="<?php echo $email_value; ?>">
<input type="tel" name="number" id="phone" placeholder="Phone" style="<?php echo $number_error; ?>" value="<?php echo $number_value; ?>">
                    <input type="text" name="address" id="address" placeholder="Address" style="<?php echo $address_error; ?>">
                    <input type="text" name="message" id="message" placeholder="Message">
                    <button id="sign" class="btn">Order Now</button>
                    
                </form>
            </aside>
        </div>
        <div id="successMessage" class="hidden">
            <p> <?php echo "Dear ".$name.",";?> Thank you for your order!</p>

        </div>

    </header>
  

        <section class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11736.673577176116!2d21.15335725!3d42.6577868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354f2cbab67d493%3A0x5c97e5834932545a!2sNEWBORN!5e0!3m2!1sen!2s!4v1674140564590!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

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
        <script>
    window.onload = function() {
        var success = "<?php echo  $namevalid && $addressvalid && $emailvalid && $numbervalid  ? 'true' : 'false'; ?>";
        
        if (success === "true") {
            var headerContent = document.querySelector(".headerContent");
            var successMessage = document.getElementById("successMessage");

            // Set the dimensions of successMessage to match headerContent
            successMessage.style.width = headerContent.offsetWidth + "px";
            successMessage.style.height = headerContent.offsetHeight + "px";

            headerContent.style.display = "none"; // Hide the header content
            successMessage.classList.remove("hidden"); // Display the success message
        }
    };
</script>

    

</body>
</html>
