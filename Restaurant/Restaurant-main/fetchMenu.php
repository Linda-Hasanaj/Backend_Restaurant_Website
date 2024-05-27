<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php'; // Ensure the DB connection is included only once

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

header('Content-Type: application/json');
echo json_encode($menu);
?>
