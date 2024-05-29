<?php
session_start();
header('Content-Type: application/json');


if (isset($_POST['name']) && isset($_POST['image'])) {

    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = array();
    }


    $foundIndex = -1;
    foreach ($_SESSION['favorites'] as $index => $favorite) {
        if ($favorite['name'] === $_POST['name'] && $favorite['image'] === $_POST['image']) {
            $foundIndex = $index;
            break;
        }
    }


    if ($foundIndex !== -1) {

        unset($_SESSION['favorites'][$foundIndex]);

        $_SESSION['favorites'] = array_values($_SESSION['favorites']);

        echo json_encode(array('status' => 'success', 'action' => 'removed', 'name' => $_POST['name'], 'image' => $_POST['image']));
    } else {

        $_SESSION['favorites'][] = array('name' => $_POST['name'], 'image' => $_POST['image']);

        echo json_encode(array('status' => 'success', 'action' => 'added', 'name' => $_POST['name'], 'image' => $_POST['image']));
    }
} else {

    echo json_encode(array('status' => 'error', 'message' => 'Name and image not provided'));
}
