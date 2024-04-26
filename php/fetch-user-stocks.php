<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//class to run query to get all user stocks from database
class UserStocksLoader
{
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
$stocksLoad = new UserStocksLoader();

//show user stocks
if (isset($_GET['username'])) {
  $username = $_GET['username'];
  $userStocks = $stocksLoad->loadUserStocks($username);
  echo $userStocks;
} else {
  echo json_encode(["error" => "Invalid username"]);
}
