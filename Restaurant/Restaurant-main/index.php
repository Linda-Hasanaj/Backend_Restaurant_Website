<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// Qasje e ndryshme e databazes per dallim nga files te tjere, ku te files tjere ju kemi casur DB përmes një PHP skripte të jashtme
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";
$port=3306;


// perdorimi i try and catch with PDO(e cila eshte metoda me e re dhe me e sygjeruar per lidhje me db!) 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_status = "Database connection successful";
    $db_status_class = "db-success";
} catch(PDOException $e) {
    $db_status = "Database connection failed: " . $e->getMessage();
    $db_status_class = "db-fail";
}

// Set a cookie
setcookie("fav_food", "burger", time() + 86400 * 2, "/"); // "/" means the cookie is available across the entire domain

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <style>
        .db-status {
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            font-family: 'Manrope', sans-serif;
        }

        .db-success {
            color: #28a745;
            border-color: #28a745;
        }

        .db-fail {
            color: #dc3545;
            border-color: #dc3545;
        }

        #hide-button {
            padding: 10px 20px; 
            background-color: #007bff; 
            color: #fff; 
            border: none;
            border-radius: 5px; 
            cursor: pointer;
            margin-top: 10px; 
        }

        #hide-button:hover {
            background-color: #0056b3; 
        }
    </style>
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
</head>
<body>
<?php if(isset($db_status)): ?>
    <div id="db-status" class="db-status <?php echo $db_status_class; ?>">
        <?php echo $db_status; ?>
    </div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            var dbStatus = document.getElementById("db-status");
            if (dbStatus) {
                dbStatus.style.display = "none";
            }
        }, 800); // 800 milliseconds = 0.8 seconds
    });
</script>

<?php include 'header.php'; ?>

<header class="header">
    <div class="headerContent hidden">
        <p>MODERN STYLE CUISINE</p>
        <h1>LATULIPE RESTAURANT</h1>
        <a href="#" onclick="scrollToSection('.section-one')" class="nav-link btn">Find More</a>
    </div>
</header>

<section class="section-one" id="section-one">
    <div class="container">
        <div class="grid-container hidden">
            <div class="tradition">
                <p class="gold-yellow">TRADITION & INNOVATION</p>
                <h2>A UNIQUE LOCATION</h2>
            </div>  
            <div class="description-one">
                <p class="gold-yellow">1955:</p>
                <h3 class="description-title">FIRST RESTAURANT</h3>
                <p class="description-text">LaTulipe offers a cuisine inspired by the local area, tradition and creativity in balanced combination quo an adhuc mediocritatem, augue. Pro sensibus gubergren an, esse ancillae principes ad vim. Vim libris maiorum corrumpit et, an vide malorum inimicus.</p>
            </div>
            <div class="description-two">
                <p class="gold-yellow">1970:</p>
                <h3 class="description-title">MICHELIN STAR</h3>
                <p class="description-text">No mea noster fierent, sale verterem mel an. Elit ignota prodesset ei nec, quod purto causae vis at. Sit stet lucilius adipiscing ei, alii sanctus gubergren te qui.</p>
            </div>
            <div class="section-one--image">
                <img src="images/home/section-two.jpg" alt="">
            </div>
            <div class="description-three">
                <p class="gold-yellow">2005:</p>
                <h3 class="description-title">HOTEL OPENING</h3>
                <p class="description-text">For a unique pleasure and relaxation experience you can try the swimming pool, the restaurants and bar or the outdoor activities. Pri magna congue minimum in, aliquip tibique intellegat  sit ex. Cu case menandri pri, cu duo quodsi integre. Vis et dolor legimus legendos.</p>
            </div>
            <div class="description-four">
                <p class="gold-yellow">2022:</p>
                <h3 class="description-title">LEGACY</h3>
                <p class="description-text">No mea noster fierent, sale verterem mel an. Elit ignota prodesset ei nec, quod purto causae vis at. Sit stet lucilius adipiscing ei, alii sanctus gubergren te qui.</p>
            </div>
        </div>
    </div>
</section>
<section class="section-two hidden">
    <div class="section-two--photos">
        <div class="section-two--photo">
            <img src="images/home/section-two-photo1.jpg" alt="">
            <div class="section-two--details">
                <p>A LA CARTE</p>
                <h3>Crab Linguine</h3>
            </div>
        </div>
        <div class="section-two--photo">
            <img src="images/home/section-two-photo2.jpg" alt="">
            <div class="section-two--details">
                <p>A LA CARTE</p>
                <h3>Crab Linguine</h3>
            </div>
        </div>
        <div class="section-two--photo">
            <img src="images/home/section-two-photo3.jpg" alt="">
            <div class="section-two--details">
                <p>A LA CARTE</p>
                <h3>Crab Linguine</h3>
            </div>
        </div>
        <div class="section-two--photo">
            <img src="images/home/section-two-photo4.jpg" alt="">
            <div class="section-two--details">
                <p>A LA CARTE</p>
                <h3>Crab Linguine</h3>
            </div>
        </div>
    </div>
</section>

<section class="section-three">
    <div class="container">
        <div class="menu hidden">
            <p class="menu-description">A LA CARTE</p>
            <h2>EXQUISITE MENU</h2>
            <p>Verear dissentiet usu ea, vis eu nominavi contentiones interpretaris, ipsum petentium percipitur has eu. Eius mutat noster pri no, justo debet intellegebat ei vel. Dolor probatus usu et. Nec erroribus laboramus scriptorem.</p>
        </div>
        <div class="menu-grid--container hidden">
            <div class="prouduct">
                <div class="prouct-img">
                    <img src="images/menu/Starters1.jpg" alt="">
                </div>
                <div class="product-title">
                    <h2>TOMATO BRUSCHETTA</h2>
                    <p>Tomates, Olive Oil, Cheese</p>
                </div>
                <div class="product-price">
                    <p>$5</p>
                </div>
            </div>

            <div class="prouduct">
                <div class="prouct-img">
                    <img src="images/menu/starters2.jpg" alt="">
                </div>
                <div class="product-title">
                    <h2>CHEESE PLATE</h2>
                    <p>Selected Cheeses, Grapes, Nuts, Bread</p>
                </div>
                <div class="product-price">
                    <p>$11</p>
                </div>
            </div>

            <div class="prouduct">
                <div class="prouct-img">
                    <img src="images/menu/starters3.jpg" alt="">
                </div>
                <div class="product-title">
                    <h2>EGGS BENEDICT</h2>
                    <p>2 Eggs, Spinach, Potatoes, Salad</p>
                </div>
                <div class="product-price">
                    <p>$9</p>
                </div>
            </div>

            <div class="prouduct">
                <div class="prouct-img">
                    <img src="images/menu/starters4.jpg" alt="">
                </div>
                <div class="product-title">
                    <h2>GUACAMOLE WITH NACHOS</h2>
                    <p>Avocado, Tomatoes, Nachos</p>
                </div>
                <div class="product-price">
                    <p>$7</p>
                </div>
            </div>

            <div class="prouduct">
                <div class="prouct-img">
                    <img src="images/menu/starters5.jpg" alt="">
                </div>
                <div class="product-title">
                    <h2>BAKED POTATO SKINS</h2>
                    <p>Potatoes, Oil, Garlic</p>
                </div>
                <div class="product-price">
                    <p>$8</p>
                </div>
            </div>

            <div class="prouduct">
                <div class="prouct-img">
                    <img src="images/menu/starters6.jpg" alt="">
                </div>
                <div class="product-title">
                    <h2>JAMBON IBERICO</h2>
                    <p>Smoked Tomato Aioli, Idizabal Cheese, Olives</p>
                </div>
                <div class="product-price">
                    <p>$10</p>
                </div>
            </div>
        </div>
        <div class="menu-button">
            <a href="menu.php" class="btn">View All Menu</a>
        </div>
    </div>
</section>

<section class="section-four">
    <div class="section-four--container hidden">
        <p class="menu-description">Book a Table Online</p>
        <h2>Reservation</h2>
        <a href="booknow.php" class="btn">Book Table</a>
    </div>
</section>
<section class="section-five">
    <div class="container">
        <div class="five-grid">
            <div class="s-five--title">
                <h1 id="teamMembers">0</h1>
                <p>team members</p>
            </div>
            <div class="s-five--title">
                <h1 id="locations">0</h1>
                <p>Locations</p>
            </div>
            <div class="s-five--title">
                <h1 id="awards">0</h1>
                <p>Awards</p>
            </div>
            <div class="s-five--title">
                <h1 id="michelinStars">0</h1>
                <p>Michelin stars</p>
            </div>
        </div>
    </div>
</section>

<section class="section-six">
    <div class="container">
        <div class="six-grid--container hidden">
            <div class="contact-us">
                <p class="menu-description">Get in touch</p>
                <h1>Contact us</h1>
                <p>Do you want to reserve a table or have a question ? Write to us via the contact form, we will answer you as soon as possible.</p>
            </div>
            <div class="contact-form hidden">
                <a href="contact.html">
                <button id="sign" class="btn" style="margin-left: 35%;">Contact Us</button>
                </a>
            </div>
            <div class="six-images">
                <div class="image1">
                    <img src="images/home/six-image-one.jpg" alt="">
                </div>
                <div class="image2">
                    <img src="images/home/six-image-two.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer" style="margin-top: -10%;">
    <div class="container">
        <div class="footer-content hidden">
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
        <div class="footer-content hidden">
            <h1>LaTulipe</h1>
        </div>
        <div class="footer-content hidden">
            <p>Monday - Friday: 9AM - 9PM</p>
            <p>Saturday: 9AM - 11PM</p>
            <p>Sunday: 9AM - 11PM</p>
            <p>Happy Hours: 9AM - 12AM</p>
        </div>
    </div>
</footer>

<script src="javascript/index.js"></script>
<script src="javascript/validimet.js"></script>
<script src="javascript/animations.js"></script>
<script src="javascript/counter.js"></script>

</body>
</html>
