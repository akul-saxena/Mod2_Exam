<?php

// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];

// Define routes and corresponding PHP files
$routes = [
  '/' => '/php/Login.php',
  '/home' => '/php/home.php',
  '/signup' => '/php/Signup.php',
  '/delete-user-stock' => '/php/delete-user-stock.php',
  '/edit-user-stock' => '/php/edit-user-stock.php',
  '/stock-entry' => '/php/stock-entry.php',
];

// Check if the requested URI matches any route
if (array_key_exists($requestUri, $routes)) {
  // Get the corresponding PHP file for the route
  $targetPhpFile = $routes[$requestUri];
  
  // Include the corresponding PHP file
  include_once(__DIR__ . $targetPhpFile);
} else {
  // Route not found, return 404 error or handle accordingly
  echo '<h1>404 - Not Found</h1>';
}
