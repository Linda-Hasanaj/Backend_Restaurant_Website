<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
</head>

<body>

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
                <li class="nav-item"><a href="delivery.php" class="nav-link">Delivery</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
                <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="booknow.php" class="nav-link btn">Book now</a></li>
            </ul>
        </nav>

        <div class="headerContent">
            <p>CLASSIC AND CREATIVE DISHES</p>
            <h1>MENU</h1>
        </div>
    </header>
    <?php
    
    $menu = array(
        array("name" => "TOMATO BRUSCHETTA", "price" => 5, "description" => "Tomates, Olive Oil, Cheese", "image" => "images/menu/Starters1.jpg"),
        array("name" => "CHEESE PLATE", "price" => 11, "description" => "Selected Cheeses, Grapes, Nuts, Bread", "image" => "images/menu/starters2.jpg"),
        array("name" => "EGGS BENEDICT", "price" => 9, "description" => "2 Eggs, Spinach, Potatoes, Salad", "image" => "images/menu/starters3.jpg"),
        array("name" => "GUACAMOLE WITH NACHOS", "price" => 7, "description" => "Avocado, Tomatoes, Nachos", "image" => "images/menu/starters4.jpg"),
        array("name" => "BAKED POTATO SKINS", "price" => 8, "description" => "Potatoes, Oil, Garlic", "image" => "images/menu/starters5.jpg"),
        array("name" => "JAMBON IBERICO", "price" => 10, "description" => "Smoked Tomato Aioli, Idizabal Cheese, Olives", "image" => "images/menu/starters6.jpg")
    );


    $newMenu = array();
    foreach ($menu as $item) {
        $newMenu[$item['price']] = $item;
    }
    
    ksort($newMenu);
     $menu = array_values($newMenu);

     $main_courses = array(
    array("name" => "BBQ RIBS", "price" => 25, "image" => "images/menu/main1.jpg", "description" => "Ribs, French Fries & Corn Bread Muffin"),
    array("name" => "CLASSIC PASTA", "price" => 20, "image" => "images/menu/main2.jpg", "description" => "Parmesan & White Wine Cream Sauce"),
    array("name" => "DUCK BREAST", "price" => 30, "image" => "images/menu/main3.jpg", "description" => "Wild Broccoli, Carrot Puree, Red Wine Jus"),
    array("name" => "ECO SALMON", "price" => 27, "image" => "images/menu/main4.jpg", "description" => "Norwegian Salmon, Wild Rice, Roasted Butternut Squash"),
    array("name" => "SRIRACHA BEEF SKEWERS", "price" => 15, "image" => "images/menu/main5.jpg", "description" => "Beef, Garlic, Sesame Oil, Winegar")
);

 $newMain=array();
 foreach( $main_courses as$item){
    $newMain[$item['price']]=$item;
 }

ksort($newMain);
$main_courses=array_values($newMain);



$desserts = array(
    array("name" => "BIG CHOCOLATE CAKE","price" => 11,"image" => "images/menu/dessert1.jpg","description" => "With Fresh Cream & Hazelnut Ice Cream" ),
    array("name" => "MACARONS","price" => 12,"image" => "images/menu/dessert2.jpg", "description" => "4 macarons with different flavors"),
    array( "name" => "ASSORTED ICE CREAM","price" => 10,"image" => "images/menu/dessert3.jpg","description" => "Berries, Chocolate & Vanilla"),
    array( "name" => "TIRAMISU","price" => 9,"image" => "images/menu/dessert4.jpg","description" => "Fabulous Italian Dessert"),
    array("name" => "SUMMER BERRY TART","price" => 12,"image" => "images/menu/dessert5.jpg","description" => "Raspberries, blackberries, blueberries")
);

$newDess=array();
foreach( $desserts as$item){
   $newDess[$item['price']]=$item;
}

ksort($newDess);
$desserts=array_values($newMain);



$wine_selection = array(
    array("SARAFIN", 17, "images/menu/wine1.jpg", "Cabernet Sauvignon 2018"),
    array("ZOE", 13, "images/menu/wine2.jpg", "Soukuras, Aghiorghitiko 2020"),
    array("POUR MA GUEULE", 19, "images/menu/wine3.jpg", "Pinot Noir 2019"),
    array("DEANGELIS", 20, "images/menu/wine4.jpg", "Montepulciano D'Abruzzo 2019")
);


rsort($wine_selection);
?>

<section class="starters">
    <div class="container">
        <div class="starters-title">
            <h1>STARTERS</h1>
        </div>
        <div class="starters-product">
            <?php foreach ($menu as $item) : ?>
                <div class="prouduct">
                    <div class="prouct-img">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    </div>
                    <div class="product-title">
                        <h2><?php echo $item['name']; ?></h2>
                        <p><?php echo $item['description']; ?></p>
                      
                    </div>
                    <div class="product-price">
                        <p>$<?php echo $item['price']; ?></p>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="main">
    <div class="container">
        <div class="starters-title">
            <h1>MAIN COURSES</h1>
        </div>
        <div class="starters-product">
            <?php foreach ($main_courses as $item) : ?>
                <div class="prouduct">
                    <div class="prouct-img">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    </div>
                    <div class="product-title">
                        <h2><?php echo $item['name']; ?></h2>
                        <p><?php echo $item['description']; ?></p>
                    </div>
                    <div class="product-price">
                        <p>$<?php echo $item['price']; ?></p>
                       
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="main">
    <div class="container">
        <div class="starters-title">
            <h1>DESSERTS</h1>
        </div>
        <div class="starters-product">
            <?php foreach ($desserts as $item) : ?>
                <div class="prouduct">
                    <div class="prouct-img">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    </div>
                    <div class="product-title">
                        <h2><?php echo $item['name']; ?></h2>
                        <p><?php echo $item['description']; ?></p> 
                        
                    </div>
                    <div class="product-price">
                        <p>$<?php echo $item['price']; ?></p>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="main">
    <div class="container">
        <div class="starters-title">
            <h1>WINE SELECTION</h1>
        </div>
        <div class="starters-product">
            <?php foreach ($wine_selection as $item) : ?>
                <div class="prouduct">
                    <div class="prouct-img">
                        <img src="<?php echo $item[2]; ?>" alt="<?php echo $item[0]; ?>">
                    </div>
                    <div class="product-title">
                        <h2><?php echo $item[0]; ?></h2>
                        <p><?php echo $item[3]; ?></p> 
                    </div>
                    <div class="product-price">
                        <p>$<?php echo $item[1]; ?></p>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
  


    

    <section class="information-section">
        <div class="container2">
            <div class="information">
                <div class="col">
                    <p>1-800-111-2222</p>
                    <h1>CALL US</h1>
                    <a href="contact.html" class="btn">Call Now</a>
                </div>
                <div class="col">
                    <p>BOOK A TABLE ONLINE</p>
                    <h1>RESERVE TABLE</h1>
                    <a href="booknow.html" class="btn">Book Table</a>
                </div>
            </div>
        </div>
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
</body>

</html>