<?php
// Include database connection
include_once "db_connect.php";

// SQL to create database
$sql = "CREATE DATABASE IF NOT EXISTS registration_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db("registration_db");

// SQL to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    surname VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    email VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    number VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    password VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    INDEX (email)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// SQL to create bookings table
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    user_date DATE DEFAULT NULL,
    time VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    people VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (user_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table bookings created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// SQL to create menu table
$sql = "CREATE TABLE IF NOT EXISTS menu (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    image VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table menu created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert menu items
$menu_items = [
    ["TOMATO BRUSCHETTA", 12.00, "Tomates, Olive Oil, Cheese", "images/menu/Starters1.jpg"],
    ["CHEESE PLATE", 18.00, "Selected Cheeses, Grapes", "images/menu/starters2.jpg"],
    ["EGGS BENEDICT", 7.00, "2 Eggs, Spinach, Potatoes", "images/menu/starters3.jpg"],
    ["GUACAMOLE", 14.00, "Avocado, Tomatoes, Nachos", "images/menu/starters4.jpg"],
    ["BAKED POTATO SKINS", 5.00, "Potatoes, Oil, Garlic", "images/menu/starters5.jpg"],
    ["JAMBON IBERICO", 25.00, "Smoked Tomato Aioli", "images/menu/starters6.jpg"]
];

$stmt = $conn->prepare("INSERT INTO menu (name, price, description, image) VALUES (?, ?, ?, ?)");

foreach ($menu_items as $item) {
    $stmt->bind_param("sdss", $item[0], $item[1], $item[2], $item[3]);
    $stmt->execute();
}

echo "Menu items inserted successfully<br>";

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?> 
