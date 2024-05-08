<?php

/**
 * @file
 * Contains the UserStocksLoader class for loading user stocks from the database.
 */

// Setting error reporting and displaying errors.
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Class UserStocksLoader for loading user stocks from the database.
 */
class UserStocksLoader
{
  /**
   * Loads user stocks from the database based on the provided username.
   *
   * @param string $username
   *   The username for which to fetch stocks.
   *
   * @return string
   *   JSON-encoded string containing the fetched user stocks or error message.
   */
  public function loadUserStocks($username)
  {
    $conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
    $query = "SELECT * FROM stock_entries WHERE username = '$username'";

    $result = mysqli_query($conn, $query);
    $res = $result->fetch_all(MYSQLI_ASSOC);

    if (is_array($res)) {
      return json_encode($res);
    } else {
      return json_encode(["error" => "Cannot fetch data"]);
    }
  }
}

// Instantiate UserStocksLoader class
$stocksLoad = new UserStocksLoader();

// Show user stocks if username is provided in the GET request
if (isset($_GET['username'])) {
  $username = $_GET['username'];
  $userStocks = $stocksLoad->loadUserStocks($username);
  echo $userStocks;
} else {
  // Return error message if username is not provided
  echo json_encode(["error" => "Invalid username"]);
}
