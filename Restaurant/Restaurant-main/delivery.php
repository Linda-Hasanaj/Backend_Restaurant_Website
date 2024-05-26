<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'error_handler.php'; // Ensure the custom error handler is included only once
require_once 'db_connect.php'; // Ensure the DB connection is included only once

if (!isset($_SESSION['favorite_items'])) {
    $_SESSION['favorite_items'] = array();
}

function addToFavorites($itemName, $itemImage) {
    $_SESSION['favorite_items'][] = array('name' => $itemName, 'image' => $itemImage);
}

include("header.php");

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/delivery.css">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="headerContent">
        <p>MODERN STYLE CUISINE</p>
        <h1>ORDER FOOD</h1>
        <input type="text" placeholder="Your Address or postal code">
    </div>

    <section class="delivery">
        <div class="menu-items">
            <div class="starters-product">
                <?php foreach ($menu as $key => $item) : ?>
                    <?php if (!file_exists($item['image'])): ?>
                        <?php trigger_error("Imazhi nuk ekziston për produktin: " . $item['name'], E_USER_WARNING); ?>
                    <?php endif; ?>
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
                    <select id="sort-option" onchange="sortMenu()" class="btn">
                        <option value="" class="btn" disabled selected hidden>SELECT SORTING</option>
                        <option value="asc" class="btn" id="sort">Price Low to High</option>
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

    <?php include("footer.php"); ?>

    <script>
        function sortMenu() {
            var sortBy = document.getElementById("sort-option").value;
            window.location.href = 'delivery.php?sort=' + sortBy;
        }
    </script>
    <script src="javascript/index.js"></script>
    <script src="javascript/delivery.js"></script>
</body>
</html>
