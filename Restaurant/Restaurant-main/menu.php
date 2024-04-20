<?php
// Start session
session_start();

// Check if favorite items array exists in session, if not, initialize it
if (!isset($_SESSION['favorite_items'])) {
    $_SESSION['favorite_items'] = array();
}

// Function to add an item to favorites
function addToFavorites($itemName, $itemImage)
{
    // Add the item to the favorite items array in session
    $_SESSION['favorite_items'][] = array('name' => $itemName, 'image' => $itemImage);
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
    <link rel="stylesheet" href="css/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>

</head>

<style>
    /* CSS styles for the different background colors */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .dark-blue-bg {
        background-color: rgb(14, 23, 33);
        color: white;
    }

    .white-bg {
        background-color: #ffffff;
        color: grey;
    }

    .black-bg {
        background-color: #000000;
        color: white;
    }

    .btn-container {
        text-align: center;
        margin-top: 20px;
    }

    .color-btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        margin: 0 10px;

    }

    /* Button container */
    .btn-container {
        position: absolute;
        top: 100px;
        right: 20px;
        background-color: var(--main-dark);
        cursor: pointer;
    }

    /* Background color buttons */
    .color-btn {
        padding: 10px 20px;
        font-size: 20px;
        border: none;
        cursor: pointer;
        margin-left: 10px;
        background-color: var(--main-dark);
        margin-top: 1em;
        cursor: pointer;
    }

    /* Hover effect */
    .color-btn:hover {
        background-color: #0056b3;
        /* Darker color on hover */
    }

    /* Additional styling for individual buttons */
    .color-btn:nth-child(2) {
        background-color: #fff;
        /* White button */
        color: #000;
    }

    /* Mode selector container */
    .mode-selector {
        position: absolute;
        /* Fixed positioning */
        top: 100px;
        /* Adjust as needed */
        right: 20px;
        /* Adjust as needed */
        text-align: center;
    }

    /* Mode selector text */
    .mode-selector p {
        margin-bottom: 10px;
        font-size: 16px;
    }

    /* CSS styles for the mode selector */
    .mode-selector {
        text-align: center;
        margin-top: 20px;
    }

    .mode-selector p {
        color: var(--gold-yellow);
        /* Change font color to gold */
    }

    .mode-selector select {
        padding: 10px 20px;
        font-size: 16px;
        border: 2px solid var(--gold-yellow);
        /* Set border to gold */
        background-color: var(--gold-black);
        /* Use CSS variable for background color */
        color: var(--gold-yellow);
        cursor: pointer;
    }

    /* Background color buttons */
    .color-btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        margin-left: 10px;
        /* Adjust as needed */
        background-color: #007bff;
        /* Default button color */
        color: #fff;
    }

    /* Hover effect */
    .color-btn:hover {
        background-color: #0056b3;
        /* Darker color on hover */
    }

    /* Additional styling for individual buttons */
    .color-btn:nth-child(2) {
        background-color: #fff;
        /* White button */
        color: #000;
    }

    /* Additional styling for individual buttons */
    .color-btn:nth-child(2) {
        background-color: #fff;
        /* White button */
        color: #000;
    }

    .paragrafi {
        font-display: italic;
        font-size: large;
        color: grey;
    }

    .mode-selector select option {
        background-color: rgb(36, 32, 34);
        /* Set background color of options to grey */
    }
</style>

<body>

    <!-- Pjesa e php per ndrrimin e theme bg color -->

    <body class="<?php echo isset($_COOKIE['background_color']) ? $_COOKIE['background_color'] : 'dark-blue-bg'; ?>">
        <header class="header">
            <!-- Your header content -->
        </header>

        <!-- Button container to choose background color -->
        <div class="mode-selector">
            <p class="paragrafi">Choose your theme:</p>
            <select id="theme-selector" onchange="changeBackgroundColor(this.value)">
                <option value="dark-blue-bg">Dark Blue</option>
                <option value="white-bg">White</option>
            </select>
        </div>


        <header class="header">
            <nav class="nav row" id="nav">
                <h1 class="header-title">LaTulipe</h1>

                <a href="javascript:void(0);" onclick="displayMenu()" class="menu-mobile" id="menu-mobile">
                    <i class="fa-solid fa-bars"></i>
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
                <p>CLASSIC AND CREATIVE DISHES</p>
                <h1>MENU</h1>
            </div>
        </header>
        <?php

        class MenuItem
        {
            private $name;
            private $price;
            private $description;
            private $image;

            public function __construct($name, $price, $description, $image)
            {
                $this->name = $name;
                $this->price = $price;
                $this->description = $description;
                $this->image = $image;
            }

            public function getName()
            {
                return $this->name;
            }

            public function getPrice()
            {
                return $this->price;
            }

            public function getDescription()
            {
                return $this->description;
            }

            public function getImage()
            {
                return $this->image;
            }
        }

        $menu = array(
            new MenuItem("TOMATO BRUSCHETTA", 5, "Tomatoes, Olive Oil, Cheese", "images/menu/Starters1.jpg"),
            new MenuItem("CHEESE PLATE", 11, "Selected Cheeses, Grapes, Nuts, Bread", "images/menu/starters2.jpg"),
            new MenuItem("EGGS BENEDICT", 9, "2 Eggs, Spinach, Potatoes, Salad", "images/menu/starters3.jpg"),
            new MenuItem("GUACAMOLE WITH NACHOS", 7, "Avocado, Tomatoes, Nachos", "images/menu/starters4.jpg"),
            new MenuItem("BAKED POTATO SKINS", 8, "Potatoes, Oil, Garlic", "images/menu/starters5.jpg"),
            new MenuItem("JAMBON IBERICO", 10, "Smoked Tomato Aioli, Idizabal Cheese, Olives", "images/menu/starters6.jpg")
        );

        $newMenu = array();
        foreach ($menu as $item) {
            $newMenu[$item->getPrice()] = $item;
        }

        ksort($newMenu);
        $menu = array_values($newMenu);

        $main_courses = array(
            new MenuItem("BBQ RIBS", 25, "Ribs, French Fries & Corn Bread Muffin", "images/menu/main1.jpg"),
            new MenuItem("CLASSIC PASTA", 20, "Parmesan & White Wine Cream Sauce", "images/menu/main2.jpg"),
            new MenuItem("DUCK BREAST", 30, "Wild Broccoli, Carrot Puree, Red Wine Jus", "images/menu/main3.jpg"),
            new MenuItem("ECO SALMON", 27, "Norwegian Salmon, Wild Rice, Roasted Butternut Squash", "images/menu/main4.jpg"),
            new MenuItem("SRIRACHA BEEF SKEWERS", 15, "Beef, Garlic, Sesame Oil, Vinegar", "images/menu/main5.jpg")
        );

        $newMain = array();
        foreach ($main_courses as $item) {
            $newMain[$item->getPrice()] = $item;
        }

        ksort($newMain);
        $main_courses = array_values($newMain);

        $desserts = array(
            new MenuItem("BIG CHOCOLATE CAKE", 11, "With Fresh Cream & Hazelnut Ice Cream", "images/menu/dessert1.jpg"),
            new MenuItem("MACARONS", 12, "4 macarons with different flavors", "images/menu/dessert2.jpg"),
            new MenuItem("ASSORTED ICE CREAM", 10, "Berries, Chocolate & Vanilla", "images/menu/dessert3.jpg"),
            new MenuItem("TIRAMISU", 9, "Fabulous Italian Dessert", "images/menu/dessert4.jpg"),
            new MenuItem("SUMMER BERRY TART", 12, "Raspberries, blackberries, blueberries", "images/menu/dessert5.jpg")
        );

        $newDess = array();
        foreach ($desserts as $item) {
            $newDess[$item->getPrice()] = $item;
        }

        ksort($newDess);
        $desserts = array_values($newDess);

        $wine_selection = array(
            new MenuItem("SARAFIN", 17, "Cabernet Sauvignon 2018", "images/menu/wine1.jpg"),
            new MenuItem("ZOE", 13, "Soukuras, Aghiorghitiko 2020", "images/menu/wine2.jpg"),
            new MenuItem("POUR MA GUEULE", 19, "Pinot Noir 2019", "images/menu/wine3.jpg"),
            new MenuItem("DEANGELIS", 20, "Montepulciano D'Abruzzo 2019", "images/menu/wine4.jpg")
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
                                <img src="<?php echo $item->getImage(); ?>" alt="<?php echo $item->getName(); ?>">
                            </div>
                            <div class="product-title">
                                <h2><?php echo $item->getName(); ?></h2>
                                <p><?php echo $item->getDescription(); ?></p>
                            </div>
                            <div class="product-price">
                                <p>$<?php echo $item->getPrice(); ?></p>
                            </div>
                            <div class="product-favorite">
                                <!-- Replace the button with a heart icon -->

                                <button class="favorite-btn" onclick="addToFavorites(this, '<?php echo $item->getName(); ?>', '<?php echo $item->getImage(); ?>')">
                                    <!-- Heart icon -->
                                    <i class="far fa-heart"></i>
                                </button>

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
                                <img src="<?php echo $item->getImage(); ?>" alt="<?php echo $item->getName(); ?>">
                            </div>
                            <div class="product-title">
                                <h2><?php echo $item->getName(); ?></h2>
                                <p><?php echo $item->getDescription(); ?></p>
                            </div>
                            <div class="product-price">
                                <p>$<?php echo $item->getPrice(); ?></p>
                            </div>
                            <div class="product-favorite">
                                <button class="favorite-btn" onclick="addToFavorites(this, '<?php echo $item->getName(); ?>', '<?php echo $item->getImage(); ?>')">
                                    <!-- Heart icon -->
                                    <i class="far fa-heart"></i>
                                </button>
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
                                <img src="<?php echo $item->getImage(); ?>" alt="<?php echo $item->getName(); ?>">
                            </div>
                            <div class="product-title">
                                <h2><?php echo $item->getName(); ?></h2>
                                <p><?php echo $item->getDescription(); ?></p>
                            </div>
                            <div class="product-price">
                                <p>$<?php echo $item->getPrice(); ?></p>
                            </div>
                            <div class="product-favorite">
                                <button class="favorite-btn" onclick="addToFavorites(this, '<?php echo $item->getName(); ?>', '<?php echo $item->getImage(); ?>')">
                                    <!-- Heart icon -->
                                    <i class="far fa-heart"></i>
                                </button>
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
                                <img src="<?php echo $item->getImage(); ?>" alt="<?php echo $item->getName(); ?>">
                            </div>
                            <div class="product-title">
                                <h2><?php echo $item->getName(); ?></h2>
                                <p><?php echo $item->getDescription(); ?></p>
                            </div>
                            <div class="product-price">
                                <p>$<?php echo $item->getPrice(); ?></p>
                            </div>
                            <div class="product-favorite">
                                <button class="favorite-btn" onclick="addToFavorites(this, '<?php echo $item->getName(); ?>', '<?php echo $item->getImage(); ?>')">
                                    <!-- Heart icon -->
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="favorites">
            <div class="container">
                <div class="favorites-title">
                    <h1>FAVORITE ITEMS</h1>
                </div>
                <div class="starters-product">
                    <div class="favorites-product">
                        <?php
                        // Check if favorites exist in the session
                        if (isset($_SESSION['favorites'])) {
                            // Loop through favorites and display each item
                            foreach ($_SESSION['favorites'] as $favorite) {
                                echo '<div class="prouduct">';
                                echo '<div class="prouct-img">';
                                echo '<img src="' . $favorite['image'] . '" alt="' . $favorite['name'] . '">';
                                echo '</div>';
                                echo '<div class="product-title">';
                                echo '<h2>' . $favorite['name'] . '</h2>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            // If no favorites exist, display a message
                            echo '<p>No favorite items selected</p>';
                        }
                        ?>
                    </div>
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
        <script>
            function addToFavorites(button, itemName, itemImage) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            var response = JSON.parse(this.responseText);
                            if (response.status === 'success') {
                                // Item added successfully, toggle class and change heart color
                                button.classList.toggle('clicked');
                                // If item was added to favorites, add it to the favorites section without refreshing
                                if (button.classList.contains('clicked')) {
                                    var favoritesSection = document.querySelector('.favorites-product');
                                    var product = document.createElement('div');
                                    product.classList.add('product');
                                    product.innerHTML = `
                            <div class="product-img">
                                <img src="${itemImage}" alt="${itemName}">
                            </div>
                            <div class="product-title">
                                <h2>${itemName}</h2>
                            </div>`;
                                    favoritesSection.appendChild(product);
                                } else {
                                    // If item was removed from favorites, remove it from the favorites section
                                    var favoriteItems = document.querySelectorAll('.favorites-product .product');
                                    favoriteItems.forEach(function(item) {
                                        if (item.querySelector('img').getAttribute('src') === itemImage) {
                                            item.remove();
                                        }
                                    });
                                }
                            } else {
                                // There was an error adding/removing the item, display the error message
                                alert(response.message);
                            }
                        } else {
                            // There was an error with the request
                            alert('Error: ' + xhr.statusText);
                        }
                    }
                };
                xhr.open("POST", "add_to_favorites.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("name=" + encodeURIComponent(itemName) + "&image=" + encodeURIComponent(itemImage));
            }
        </script>


        <script>
            // Function to change the background color and set the cookie
            function changeBackgroundColor(color) {
                document.body.className = color;
                document.cookie = "background_color=" + color + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            }
        </script>

    </body>

</html>