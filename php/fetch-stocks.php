<?php

/**
 * @file
 * Contains the StocksLoader class for fetching stocks from the database.
 */

// Setting error reporting and displaying errors.
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Class StocksLoader for fetching stocks from the database.
 */
class StocksLoader
{
    /**
     * Loads stocks from the database.
     *
     * @return string
     *   JSON-encoded string containing the fetched stocks or error message.
     */
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

// Instantiate StocksLoader class and load stocks
$stocksLoad = new StocksLoader();
$stocks = $stocksLoad->loadStocks();
echo $stocks;
