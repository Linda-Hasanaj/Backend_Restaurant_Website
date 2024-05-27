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

function get_menu_html($menu) {
    $html = '';
    foreach ($menu as $key => $item) {
        if (!file_exists($item['image'])) {
            trigger_error("Image does not exist for product: " . $item['name'], E_USER_WARNING);
        }
        $html .= '<div class="product">';
        $html .= '<div class="product-img"><img src="' . $item['image'] . '" alt="' . $item['name'] . '"></div>';
        $html .= '<div class="product-title"><h2 id="item-' . ($key + 1) . '">' . $item['name'] . '</h2>';
        $html .= '<p>' . $item['description'] . '</p></div>';
        $html .= '<div class="product-price"><p>$ <span id="price-' . ($key + 1) . '">' . $item['price'] . '</span></p>';
        $html .= '<button class="btn add-to-cart" data-name="' . $item['name'] . '" data-price="' . $item['price'] . '">Add to cart</button></div>';
        $html .= '</div>';
    }
    return $html;
}

if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    echo get_menu_html($menu);
    exit();
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
<?php include 'header.php'; ?>  
    <div class="headerContent">
        <p>MODERN STYLE CUISINE</p>
        <h1>ORDER FOOD</h1>
        <input type="text" placeholder="Your Address or postal code">
    </div>

    <section class="delivery">
        <div class="menu-items">
            <div class="starters-product" id="menu-container">
                <?php echo get_menu_html($menu); ?>
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
        let cart = [];
        let total = 0;

        function sortMenu() {
            const sortBy = document.getElementById("sort-option").value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'delivery.php?ajax=1&sort=' + sortBy, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('menu-container').innerHTML = xhr.responseText;
                    attachEventListeners(); // Re-attach event listeners after AJAX update
                }
            };
            xhr.send();
        }

        function attachEventListeners() {
            document.querySelectorAll('.add-to-cart').forEach(function(button) {
                button.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const price = parseFloat(this.getAttribute('data-price'));
                    addToCart(name, price);
                });
            });
            document.getElementById('order-now').addEventListener('click', function() {
                alert('Order placed!');
                // Add your order handling logic here
            });
            document.getElementById('clear').addEventListener('click', function() {
                clearCart();
            });
        }

        function addToCart(name, price) {
            cart.push({ name, price });
            total += price;
            updateCart();
        }

        function updateCart() {
            const cartContainer = document.getElementById('cart');
            cartContainer.innerHTML = '';
            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.textContent = `${item.name} - $${item.price}`;
                cartContainer.appendChild(cartItem);
            });
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        function clearCart() {
            cart = [];
            total = 0;
            updateCart();
        }

        document.addEventListener('DOMContentLoaded', function() {
            attachEventListeners();
        });
    </script>
    <script src="javascript/index.js"></script>
    <script src="javascript/delivery.js"></script>
</body>
</html>
