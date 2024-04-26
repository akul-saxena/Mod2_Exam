<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//function to fetch stocks from db
class StocksLoader
{
    public function loadStocks()
    {
        $conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
        $query = "SELECT * FROM stock_entries";

        $result = mysqli_query($conn, $query);
        $res = $result->fetch_all(MYSQLI_ASSOC);

        if (is_array($res)) {
            return json_encode($res);
        } else {
            return json_encode(["error" => "Cannot fetch data"]);
        }
    }
}
$stocksLoad = new StocksLoader();
$stocks = $stocksLoad->loadStocks();
echo $stocks;
