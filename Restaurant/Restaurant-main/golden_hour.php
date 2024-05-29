<?php
function getSunriseSunsetData($lat, $lng, $timezone, $date) {
    // url of api
    $apiUrl = "https://api.sunrisesunset.io/json?lat=$lat&lng=$lng&timezone=$timezone&date=$date";
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // is set to true, meaning the response should be returned as a string rather than output directly.

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true); // It decodes the JSON response into an associative array.
    return $response; //  It returns the decoded response.
}

if (isset($_GET['date'])) {
    $lat = 42.6629;
    $lng = 21.1655;
    $timezone = 'Europe/Pristina';
    $date = $_GET['date'];

    $sunData = getSunriseSunsetData($lat, $lng, $timezone, $date);

    if (isset($sunData['results'])) {
        // nese ka rezultate atehere it will display the golden hour 
        echo json_encode(['golden_hour' => $sunData['results']['golden_hour']]);
    } else {
        // error handling!
        echo json_encode(['error' => 'No sunrise and sunset data found or there was an error.']);
    }
    exit;
}
?>
