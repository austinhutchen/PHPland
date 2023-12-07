<?php
// Function to send GET request to the ESP32 server
function sendGetRequest($url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

// Function to send POST request to the ESP32 server
function sendPostRequest($url, $data) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

// Example GET request to the ESP32
$esp32_ip = 'ESP32_SERVER_IP_ADDRESS';
$get_response = sendGetRequest("http://$esp32_ip/some_endpoint");

echo "GET Response: " . $get_response . "\n";

?>
