<?php
// Include database connection
include_once "db_connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $userdate = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    
    // Assuming you have a session with user information
    session_start();
    $user_id = $_SESSION['user_id']; // Adjust this according to your session handling

    // Validate form data
    if (!empty($user_id) && !empty($userdate) && !empty($time) && !empty($people)) {
        // Create a prepared statement to insert data into the database
        $sql = "INSERT INTO bookings (user_id, user_date, time, people) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bind_param("isss", $user_id, $userdate, $time, $people);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Booking saved successfully, redirect to booknow.php with success message
            header("Location: booknow.php?success=1");
            exit();
        } else {
            // Error saving booking
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle validation errors
        echo "Error: All fields are required!";
    }
}

// Close the database connection
$conn->close();
?>
