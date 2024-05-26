<?php
include 'db_connect.php';

header("Content-Type: application/json");
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            // Retrieve a single reservation
            $id = intval($_GET["id"]);
            get_reservation($id);
        } else {
            // Retrieve all reservations
            get_reservations();
        }
        break;
    case 'POST':
        // Create a new reservation
        create_reservation();
        break;
    case 'PUT':
        // Update an existing reservation
        $id = intval($_GET["id"]);
        update_reservation($id);
        break;
    case 'DELETE':
        // Delete a reservation
        $id = intval($_GET["id"]);
        delete_reservation($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_reservations() {
    global $conn;
    $query = "SELECT bookings.*, users.name, users.surname, users.email, users.number 
              FROM bookings 
              JOIN users ON bookings.user_id = users.id";
    $response = [];
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function get_reservation($id) {
    global $conn;
    $query = "SELECT bookings.*, users.name, users.surname, users.email, users.number 
              FROM bookings 
              JOIN users ON bookings.user_id = users.id 
              WHERE bookings.id = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo json_encode($row, JSON_PRETTY_PRINT);
}

function create_reservation() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $user_id = $data["user_id"];
    $user_date = $data["user_date"];
    $time = $data["time"];
    $people = $data["people"];

    $query = "INSERT INTO bookings (user_id, user_date, time, people) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $user_id, $user_date, $time, $people);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Reservation created successfully', 'reservation_id' => $stmt->insert_id], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['success' => false, 'message' => 'Reservation creation failed'], JSON_PRETTY_PRINT);
    }
}

function update_reservation($id) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $user_id = $data["user_id"];
    $user_date = $data["user_date"];
    $time = $data["time"];
    $people = $data["people"];

    $query = "UPDATE bookings SET user_id=?, user_date=?, time=?, people=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssi", $user_id, $user_date, $time, $people, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Reservation updated successfully'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['success' => false, 'message' => 'Reservation update failed'], JSON_PRETTY_PRINT);
    }
}

function delete_reservation($id) {
    global $conn;
    $query = "DELETE FROM bookings WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Reservation deleted successfully'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['success' => false, 'message' => 'Reservation deletion failed'], JSON_PRETTY_PRINT);
    }
}
