<?php

use App\Controller\FibonacciSetsController;
require "../start.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

/** all endpoints start with /fibonacciset or /fibonaccisets
everything else results in a 404 Not Found */

if ($uri[1] !== 'fibonacciSet') {

    if($uri[1] !== 'fibonacciSets'){
        header("HTTP/1.1 404 Not Found");
        exit();
    }
    
}

if ($uri[1] == 'fibonacciSets' and isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

/** set id: optional & a number: */
$fibonacciSetId = null;
if (isset($uri[2])) {
    $fibonacciSetId = (int) $uri[2];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

/** passing the request method and set ID to the controller and processing the HTTP request:*/
$controller = new FibonacciSetsController($dbConnection, $requestMethod, $fibonacciSetId);
$controller->processRequest();