<?php

include '../vendor/autoload.php';

// Setup HTTP Client
use GuzzleHttp\Client;
$client = new Client([ 'timeout'  => 2.0 ]);

// Set content type
Header('Content-Type: application/json');

// Set auth services
$authUrls = [
    "mojang" => "https://sessionserver.mojang.com/session/minecraft/hasJoined",
    "minehut" => "https://api.minehut.com/mitm/proxy/session/minecraft/hasJoined"
];

// Prep urls
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query = $_SERVER['QUERY_STRING'];

// Get the services
$authServices = $path;

// Prep the area with some sanitizing
$authServices = str_replace("session/minecraft/hasJoined", '', $authServices);
$authServices = str_replace("//", "", $authServices);
$authServices = explode("/", $authServices);
$authServices = array_filter($authServices);

// If no params
// or more than 2 services to protect CPU time
if(!$query || count($authServices) > 5) {
    echo "Incorrect URL";
    return;
}

// Loop through services
foreach($authServices as $authService) {
    // Check valid service in array
    if(!isset($authUrls[$authService])) continue;

    // Get the auth URL
    $authUrl = $authUrls[$authService];

    // Get the auth url for authentication
    $modifiedUrl = "$authUrl?$query";

    // Send modified request
    $response = $client->get($modifiedUrl);

    // If the response is not valid, loop to the next
    if($response->getStatusCode() != 200) continue;

    // Return the response
    echo $response->getBody();
    return;
}

// If no valid response, fail
http_response_code(204);