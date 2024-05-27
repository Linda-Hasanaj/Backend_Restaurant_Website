<?php
// Start session
session_start();

// Include the common header
include("header.php");

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Define validation patterns
$name_pattern = "/^[a-zA-Z]+(?:\\s+[a-zA-Z]+)*$/";
$email_pattern = "/^[^ ]+@[^ ]+\\.[a-z]{2,3}$/";
$mobileno_pattern = "/^\\d{8,}$/";
$message_pattern = "/^[a-zA-Z0-9\\s]{1,100}$/";

$name_error = $email_error = $phone_error = $message_error = "";
$name = $email = $phone = $message = "";
$namevalid = $emailvalid = $numbervalid = $messagevalid = false;

function capitalizeFirstLetter($string) {
    return preg_replace_callback(
        '/\\b\\w/i',
        function($matches) {
            return strtoupper($matches[0]);
        },
        $string
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if (empty($name)) {
        $name_error = "Name is required";
    } elseif (!preg_match($name_pattern, $name)) {
        $name_error = "Only letters and white space allowed";
    } else {
        $namevalid = true;
    }

    // Validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $email_error = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    } else {
        $emailvalid = true;
    }

    // Validate phone number
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    if (empty($phone)) {
        $phone_error = "Phone number is required";
    } elseif (!preg_match($mobileno_pattern, $phone)) {
        $phone_error = "Invalid phone number";
    } else {
        $numbervalid = true;
    }

    // Validate message
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    if (empty($message)) {
        $message_error = "Message is required";
    } elseif (!preg_match($message_pattern, $message)) {
        $message_error = "Invalid message";
    } else {
        $messagevalid = true;
    }

    if ($namevalid && $emailvalid && $numbervalid && $messagevalid) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'lumhoxha780@gmail.com';  // SMTP username
            $mail->Password   = 'pwvbtarmhbwqmgbl';       // SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Email to site admin
            $mail->setFrom($email, $name);
            $mail->addAddress('lumhoxha780@gmail.com'); // Your email
            $mail->addReplyTo($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Subject from Contact Form';
            $mail->Body    = 'Message: ' . $message;

            $mail->send();

            // Email to the user
            $mail->clearAddresses();
            $mail->addAddress($email); // Send email to the user
            $mail->Subject = "Thank you for contacting us";
            $mail->Body    = "Dear $name,<br><br>Thank you for contacting us. We have received your message and will get back to you soon.<br><br>Best regards,<br>LaTulipe team!";
            $mail->AltBody = "Dear $name,\n\nThank you for contacting us. We have received your message and will get back to you soon.\n\nBest regards,\nLaTulipe TEAM!";

            $mail->send();

            echo "<script>alert('Message sent successfully!');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    }
}
?>

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
    <title>Contact</title>
</head>

<body>

    <div class="headerContent">
        <p>RESERVE YOUR TABLE</p>
        <h1>CONTACT</h1>
    </div>

    <section class="contact-starters">
        <div class="contact-info">
            <div class="button-contact">
                <div class="icon-contact">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="contact-details">
                    <h3>FIND RESTAURANT</h3>
                    <p>40 Park Ave, Brooklyn, New York</p>  
                </div>
            </div>

            <div class="button-contact">
                <div class="icon-contact">
                    <i class="fa-solid fa-mobile-screen"></i>
                </div>
                <div class="contact-details">
                    <h3>PHONE & EMAIL</h3>
                    <p>1-800-111-2222</p>
                    <p>contact@example.com</p> 
                </div>
            </div>

            <div class="button-contact">
                <div class="icon-contact">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="contact-details">
                    <h3>OPEN HOURS</h3>
                    <p>Monday - Thursday: 9AM - 9PM</p>
                    <p>Friday- Sunday: 9AM - 12PM</p>
                </div>
            </div>
        </div>

        <aside class="contact-form">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name="name" id="name" placeholder="Name" style="<?php echo $name_error; ?>">
                <input type="email" name="email" id="email" placeholder="Email" style="<?php echo $email_error;?>">
                <input type="tel" name="phone" id="phone" placeholder="Phone" style="<?php echo $phone_error; ?>">
                <input type="text" name="message" id="message" placeholder="Message" style="<?php echo $message_error; ?>">
                <button type="submit" name="send" id="contact-submit" class="btn">Send Message</button>
            </form>
        </aside>
    </section>

    <section class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11736.673577176116!2d21.15335725!3d42.6577868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354f2cbab67d493%3A0x5c97e5834932545a!2sNEWBORN!5e0!3m2!1sen!2s!4v1674140564590!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <?php include("footer.php"); ?>

    <script src="javascript/index.js"></script>

</body>
</html>