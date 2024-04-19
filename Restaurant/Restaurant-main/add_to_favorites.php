<?php
session_start();

// Check if name and image are set
if (isset($_POST['name']) && isset($_POST['image'])) {
    // Initialize favorites array if it doesn't exist in the session
    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array();
    }

    // Add the selected item to favorites
    $_SESSION['favorites'][] = array('name' => $_POST['name'], 'image' => $_POST['image']);

    // Send success response
    echo json_encode(array('status' => 'success', 'message' => 'Item added to favorites'));
} else {
    // Send error response
    echo json_encode(array('status' => 'error', 'message' => 'Name and image not provided'));
}
