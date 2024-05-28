<?php
session_start();
header('Content-Type: application/json');

// Check if name and image are set
if (isset($_POST['name']) && isset($_POST['image'])) {
    // Initialize favorites array if it doesn't exist in the session
    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array();
    }

    // Check if item is already in favorites
    $foundIndex = -1;
    foreach ($_SESSION['favorites'] as $index => $favorite) {
        if ($favorite['name'] === $_POST['name'] && $favorite['image'] === $_POST['image']) {
            $foundIndex = $index;
            break;
        }
    }

    // If item is already in favorites, remove it; otherwise, add it
    if ($foundIndex !== -1) {
        // Remove item from favorites
        unset($_SESSION['favorites'][$foundIndex]);
        // Reindex the array to avoid issues with numeric keys
        $_SESSION['favorites'] = array_values($_SESSION['favorites']);
        // Send success response indicating item was removed from favorites
        echo json_encode(array('status' => 'success', 'action' => 'removed', 'name' => $_POST['name'], 'image' => $_POST['image']));
    } else {
        // Add the selected item to favorites
        $_SESSION['favorites'][] = array('name' => $_POST['name'], 'image' => $_POST['image']);
        // Send success response indicating item was added to favorites
        echo json_encode(array('status' => 'success', 'action' => 'added', 'name' => $_POST['name'], 'image' => $_POST['image']));
    }
} else {
    // Send error response
    echo json_encode(array('status' => 'error', 'message' => 'Name and image not provided'));
}
