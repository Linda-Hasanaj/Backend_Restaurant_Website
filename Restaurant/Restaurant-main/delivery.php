<?php
session_start(); // e kemi hap nje sesion ne menyre qe te ruajme cart items
require_once 'error_handler.php';
require_once 'db_connect.php'; // lidhje me db

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

function addToCart($item) {
    $_SESSION['cart'][] = $item;
}

$menu = array();
$sortByPrice = $_GET['sort'] ?? '';

$order = '';
if ($sortByPrice == 'asc') {
    $order = 'ORDER BY price ASC';
} elseif ($sortByPrice == 'desc') {
    $order = 'ORDER BY price DESC';
}

$sql = "SELECT name, price, description, image FROM menu $order";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu[] = $row; 
        // Retrieves menu items from the database and sorts them based on the query parameter sort.
    }
}

function get_menu_html($menu) {
    $html = '';
    foreach ($menu as $key => $item) {
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
    // Outputs the menu items as HTML if the request is an AJAX request.
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

    <script src="javascript/index.js"></script>
    <script src="javascript/delivery.js"></script>
    
</body>
</html>
