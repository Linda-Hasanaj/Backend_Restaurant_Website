<?php
session_start();
include('header.php');
include('db_connect.php'); // Ensure this path is correct

date_default_timezone_set("Europe/Tirane");
$currentDate = date("Y-m-d");
$datevalid = false;
$pvalid = false;
$timevalid = false;
$error1 = "";
$error2 = "";
$error3 = "";

function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userdate = input_data($_POST['date']);
    $person = input_data($_POST['people']);
    $time = input_data($_POST['time']);
    
    if ($userdate > $currentDate && !empty($userdate)) {
        $datevalid = true;
    } else {
        $error1 = "border: 1px solid red;";
    }
    if (!empty($person)) {
        $pvalid = true;
    } else {
        $error2 = "border: 1px solid red;";
    }
    if (!empty($time)) {
        $timevalid = true;
    } else {
        $error3 = "border: 1px solid red;";
    }

    if ($datevalid && $pvalid && $timevalid) {
        if (isset($_SESSION['reservation_count'])) {
            $_SESSION['reservation_count']++;
        } else {
            $_SESSION['reservation_count'] = 1;
        }

        // Ensure user_id is available
        $user_id = $_SESSION['user_id'] ?? null; // Adjust according to how user_id is managed in your session

        if ($user_id) {
            // Insert reservation into the database
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, user_date, time, people, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
            $stmt->bind_param("isss", $user_id, $userdate, $time, $person);

            if ($stmt->execute()) {
                // Log the reservation
                $file_path = "/Applications/XAMPP/xamppfiles/htdocs/Restaurant/Restaurant/Restaurant-main/reservations.txt";
                $logfile = fopen($file_path, "a");

                if ($logfile !== false) {
                    $logEntry = "Reservation made on " . $userdate . " for " . $person . " people at " . $time . " on " . date("Y-m-d H:i:s") . "\n";
                    fwrite($logfile, $logEntry);
                    fclose($logfile);
                }

                echo "<div class='message-box'>Successfully written to the reservation.txt[file] and INTO THE TABLE RESERVATION[database].</div>";
                echo "<script>setTimeout(function() { document.querySelector('.message-box').style.display = 'none'; }, 1500);</script>";
            } else {
                echo "<div class='message-box'>Error: " . $stmt->error . "</div>";
                echo "<script>setTimeout(function() { document.querySelector('.message-box').style.display = 'none'; }, 1500);</script>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<div class='message-box'>Error: User ID is missing.</div>";
            echo "<script>setTimeout(function() { document.querySelector('.message-box').style.display = 'none'; }, 1500);</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/booknow.css">
    <script src="https://kit.fontawesome.com/1506ca5daa.js" crossorigin="anonymous"></script>
    <style>
        .nav-item:nth-child(4) .nav-link {
            color: white;
        }
        .hidden {
            display: none;
        }
        #successMessage p {
            margin: 0;
            background-color: rgba(0, 0, 0, 0.6);
            text-align: center;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Crimson Text', serif;
        }
        .headerContent {
            text-align: center;
            color: white;
            margin-top:1%;
        }
        .headerContent h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .inputs form {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .inputs input[type="date"],
        .inputs select,
        .inputs button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }
        .inputs button {
            background-color: #ff6600;
            cursor: pointer;
        }
        .inputs button:hover {
            background-color: #e65c00;
        }
        .message-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #333;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
    </style>
</head>
<body>
<div class="headerContent">
    <h1>BOOK NOW</h1>
    <div class="inputs">
        <form method="POST" action="">
            <input type="date" id="date" name="date" style="<?php echo $error1; ?>" required>
            <select name="time" id="time" style="<?php echo $error3; ?>" required>
                <option value="">Time</option>
                <option value="14-00">14:00</option>
                <option value="15-00">15:00</option>
                <option value="16-00">16:00</option>
                <option value="17-00">17:00</option>
                <option value="18-00">18:00</option>
                <option value="19-00">19:00</option>
                <option value="20-00">20:00</option>
                <option value="21-00">21:00</option>
                <option value="22-00">22:00</option>
            </select>
            <select name="people" id="people" style="<?php echo $error2; ?>" required>
                <option value="">People</option>
                <option value="1">1 Person</option>
                <option value="2">2 People</option>
                <option value="3">3 People</option>
                <option value="4">4 People</option>
                <option value="5">5 People</option>
                <option value="6">6 People</option>
                <option value="7">7 People</option>
            </select>
            <button type="submit" class="btn btn-2">Book Now</button>
        </form>
    </div>
</div>

<div id="successMessage" class="hidden">
    <p style="font-size: 50px;">Booking successful!  <br> <span style="font-size: 20px; ">Booking times: <?php echo $_SESSION['reservation_count']; ?></span></p>
</div>

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
    window.onload = function() {
        var success = "<?php echo isset($_GET['success']) && $_GET['success'] == 1 ? 'true' : 'false'; ?>";
        if (success === "true") {
            var headerContent = document.querySelector(".headerContent");
            var successMessage = document.getElementById("successMessage");
            successMessage.style.width = headerContent.offsetWidth + "px";
            successMessage.style.height = headerContent.offsetHeight + "px";
            headerContent.style.display = "none";
            successMessage.classList.remove("hidden");
        }
    };
</script>
</body>
</html>
