<?php
session_start();
require_once 'error_handler.php';
require_once 'db_connect.php';

class CartException extends Exception {
    public function errorMessage() {
        return "Gabim: " . $this->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("You have to be loged in!");
        }
        if (empty($_SESSION['cart'])) {
            throw new Exception("Shopping cart is empty.");
        }

        $userId = $_SESSION['user_id'];
        $address = $_POST['address'];
        $orderDate = date('Y-m-d H:i:s');

        if (empty($address)) {
            throw new CartException("Ju lutemi siguroni një adresë për dorëzim.");
        } else {
            foreach ($_SESSION['cart'] as $item) {
                $itemName = $item['name'];
                $itemPrice = $item['price'];
                $quantity = $item['quantity'];
                $totalAmount = $itemPrice * $quantity;

                $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, item_name, item_price, quantity, total_amount, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt) {
                    throw new Exception("Prepare statement failed: " . $conn->error);
                }

                $stmt->bind_param("issdiis", $userId, $orderDate, $itemName, $itemPrice, $quantity, $totalAmount, $address);

                if (!$stmt->execute()) {
                    throw new Exception("Execute statement failed: " . $stmt->error);
                }

                $stmt->close();
            }

            $_SESSION['cart'] = array();
            header('Location: index.php');
            exit();
        }
    } catch (CartException $e) {
        $error_message = $e->errorMessage();
    } catch (Exception $e) {
        $error_message = "Një gabim i papritur ndodhi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/contact.css">
    <style>
        .error { color: red; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<aside class="contact-form">
<?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
    <form method="POST" action="checkout.php">
        <label for="address">Adresa e dorëzimit:</label>
        <input type="text" id="address" name="address" required>
        <button type="submit" class="btn">Konfirmo Porosinë</button>
    </form>
</aside>

<section class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11736.673577176116!2d21.15335725!3d42.6577868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354f2cbab67d493%3A0x5c97e5834932545a!2sNEWBORN!5e0!3m2!1sen!2s!4v1674140564590!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
<script src="javascript/delivery.js"></script>
</body>
</html>