<?php
session_start();
include("header.php");
include("db_connect.php");

// Use session to get the logged-in user ID
$user_id = $_SESSION['user_id']; // Assume 1 for now if session is not set

$name_error = $surname_error = $email_error = $number_error = $current_password_error = $new_password_error = "";
$name = $surname = $email = $number = $current_password = $new_password = "";
$namevalid = $surnamevalid = $emailvalid = $numbervalid = $current_password_valid = $new_password_valid = false;

// Fetch user data
if ($stmt = $conn->prepare("SELECT name, surname, email, number, password FROM users WHERE id = ?")) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name, $surname, $email, $number, $hashed_password);
    $stmt->fetch();
    $stmt->close();
}

function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $name_error = "border-bottom: 1px solid red;";
    } else {
        $name = input_data($_POST["name"]);
        $namevalid = true;
    }

    if (empty($_POST["surname"])) {
        $surname_error = "border-bottom: 1px solid red;";
    } else {
        $surname = input_data($_POST["surname"]);
        $surnamevalid = true;
    }

    if (empty($_POST["email"])) {
        $email_error = "border-bottom: 1px solid red;";
    } else {
        $email = input_data($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "border-bottom: 1px solid red;";
        } else {
            $emailvalid = true;
        }
    }

    if (empty($_POST["number"])) {
        $number_error = "border-bottom: 1px solid red;";
    } else {
        $number = input_data($_POST["number"]);
        $numbervalid = true;
    }

    if (empty($_POST["current_password"])) {
        $current_password_error = "border-bottom: 1px solid red;";
    } else {
        $current_password = input_data($_POST["current_password"]);
        if (!password_verify($current_password, $hashed_password)) {
            $current_password_error = "border-bottom: 1px solid red;";
        } else {
            $current_password_valid = true;
        }
    }

    if (!empty($_POST["new_password"])) {
        $new_password = password_hash(input_data($_POST["new_password"]), PASSWORD_DEFAULT);
        $new_password_valid = true;
    }

    if ($namevalid && $surnamevalid && $emailvalid && $numbervalid && $current_password_valid) {
        $query = "UPDATE users SET name = ?, surname = ?, email = ?, number = ?";
        $params = [$name, $surname, $email, $number];

        if ($new_password_valid) {
            $query .= ", password = ?";
            $params[] = $new_password;
        }
        $query .= " WHERE id = ?";
        $params[] = $user_id;

        $stmt = $conn->prepare($query);
        if ($new_password_valid) {
            $stmt->bind_param("sssssi", ...$params);
        } else {
            $stmt->bind_param("ssssi", ...$params);
        }

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>User Profile</title>
</head>
<body>

<div class="profile-container">
    <h1>User Profile</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" style="<?php echo $name_error; ?>">
            <?php if ($name_error): ?><p class="error">Please enter your first name.</p><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="surname">Last Name</label>
            <input type="text" name="surname" id="surname" value="<?php echo htmlspecialchars($surname); ?>" style="<?php echo $surname_error; ?>">
            <?php if ($surname_error): ?><p class="error">Please enter your last name.</p><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" style="<?php echo $email_error; ?>">
            <?php if ($email_error): ?><p class="error">Please enter a valid email address.</p><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="number">Phone Number</label>
            <input type="tel" name="number" id="number" value="<?php echo htmlspecialchars($number); ?>" style="<?php echo $number_error; ?>">
            <?php if ($number_error): ?><p class="error">Please enter your phone number.</p><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" placeholder="Enter current password" style="<?php echo $current_password_error; ?>">
            <?php if ($current_password_error): ?><p class="error">Current password is incorrect.</p><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" placeholder="Enter new password" style="<?php echo $new_password_error; ?>">
        </div>
        <button type="submit" <button type="submit" class="btn">Update Profile</button>
    </form>
</div>

</body>
</html>

