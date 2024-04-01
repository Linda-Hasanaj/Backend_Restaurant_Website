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
    <link rel="stylesheet" href="css/delivery.css">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
</head>
<style>
   


</style>
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
                <li class="nav-item"><a href="menu.html" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="delivery.php" class="nav-link">Delivery</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
                <li class="nav-item"><a href="register.html" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="booknow.html" class="nav-link btn">Book now</a></li>
            </ul>
        </nav>

        <div class="headerContent">
            <p>MODERN STYLE CUISINE</p>
            <h1>ORDER FOOD</h1>
            <input type="text" placeholder="Your Address or postal code">
        </div>

    </header>
   <?php
$menu = array(
    array("name" => "TOMATO BRUSCHETTA", "price" => 12, "description" => "Tomates, Olive Oil, Cheese", "image" => "images/menu/Starters1.jpg"),
    array("name" => "CHEESE PLATE", "price" => 18, "description" => "Selected Cheeses, Grapes", "image" => "images/menu/starters2.jpg"),
    array("name" => "EGGS BENEDICT", "price" => 7, "description" => "2 Eggs, Spinach, Potatoes", "image" => "images/menu/starters3.jpg"),
    array("name" => "GUACAMOLE", "price" => 14, "description" => "Avocado, Tomatoes, Nachos", "image" => "images/menu/starters4.jpg"),
    array("name" => "BAKED POTATO SKINS", "price" => 5, "description" => "Potatoes, Oil, Garlic", "image" => "images/menu/starters5.jpg"),
    array("name" => "JAMBON IBERICO", "price" => 25, "description" => "Smoked Tomato Aioli", "image" => "images/menu/starters6.jpg")
);


$sortByPrice = $_GET['sort'] ?? ''; 
if ($sortByPrice == 'asc') {
    
    usort($menu, function($a, $b) {
        return $a['price'] - $b['price'];
    });
} elseif ($sortByPrice == 'desc') {
   
    usort($menu, function($a, $b) {
        return $b['price'] - $a['price'];   
    });
}

?>


<section class="delivery">
<div class="menu-items">
    <div class="starters-product">
        <?php foreach ($menu as $key => $item) : ?>
            <div class="product">
                <div class="product-img">
                    <img src="<?php echo $item['image']; ?>" alt="">
                </div>
                <div class="product-title">
                    <h2 id="item-<?php echo $key + 1; ?>"><?php echo $item['name']; ?></h2>
                    <p><?php echo $item['description']; ?></p>
                </div>
                <div class="product-price">
                    <p>$ <span id="price-<?php echo $key + 1; ?>"><?php echo $item['price']; ?></span></p>
                    <button class="btn" id="add-item-<?php echo $key + 1; ?>">Add to cart</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


        <aside class="ordered-items">
        <div class="total">
        <div class="order-button">
        <select id="sort-option"  onchange="sortMenu()" class="btn">
    <option value="" class="btn"  disabled selected hidden>SELECT SORTING</option>
    <option value="asc " class="btn" id="sort">Price Low to High</option>
    <option value="desc" class="btn" id="sort">Price High to Low</option>
</select>
</div>
        </div>

            <div class="orders-title">
                <h2>Your order</h2>
            </div>
            <div class="food-items" id="cart"></div>
            <div class="total">
                <h2>TOTAL</h2>
                <p class="price" id="total">$0</p>
            </div>
            <div class="order-button">
                <button class="btn" id="order-now">ORDER NOW</button>
                <button class="btn" id="clear">CLEAR</button>
            </div>
        </aside>
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
    <script>
       
        function sortMenu() {
            var sortBy = document.getElementById("sort-option").value; 
            window.location.href = 'delivery.php?sort=' + sortBy; 
        }
        </script>
    <script src="javascript/index.js"></script>
    <script src="javascript/delivery.js"></script>
    

</body>
