<?php

/**
 * @file
 * Handles stock entry and database operations.
 */

try {
  // Class for handling stock entry
  class StockEntry
  {
    private $conn;

    /**
     * Constructor method.
     */
    public function __construct()
    {
      // Make database connection
      $this->conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
      if ($this->conn->connect_error) {
        throw new Exception('Failed to connect to database: ' . $this->conn->connect_error);
      }
    }

    /**
     * Add a new stock entry.
     *
     * @param array $stockData
     *   Array containing stock data (stockName, stockPrice).
     *
     * @throws Exception
     *   If entry fails or an error occurs.
     */
    public function addStock($stockData)
    {
      session_start();
      $stockName = $stockData['stockName'];
      $stockPrice = $stockData['stockPrice'];

      // Check if any field is empty
      if (empty($stockName) || empty($stockPrice)) {
        throw new Exception("Please fill in all fields");
      }

      // Set timezone
      date_default_timezone_set('Asia/Kolkata');
      $createdDate = date('Y-m-d H:i:s', time());
      $updatedDate = $createdDate;
      $username = $_SESSION["username"];

      $this->conn->begin_transaction();
      // Prepare and execute insert query
      $query = "INSERT INTO stock_entries (username, stock_name, stock_price, created_date, last_updated) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param("sssss", $username, $stockName, $stockPrice, $createdDate, $updatedDate);
      if (!$stmt->execute()) {
        throw new Exception("Error: " . $stmt->error);
      } else {
        $this->conn->commit();
        echo "<script>window.location.href = '/home';</script>";
        exit;
      }
    }

    /**
     * Destructor method to close database connection.
     */
    public function __destruct()
    {
      if ($this->conn) {
        $this->conn->close();
      }
    }
  }

  // Check if form is submitted
  if (isset($_POST["submit"])) {
    // Initialize StockEntry class
    $stockEntry = new StockEntry();
    // Stock data from form
    $stockData = [
      'stockName' => $_POST['stockName'],
      'stockPrice' => $_POST['stockPrice']
    ];
    // Add new stock entry
    $stockEntry->addStock($stockData);
  }
} catch (Exception $e) {
  // Display error message and redirect to stock-entry
  echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
  echo "<script>window.location.href = '/stock-entry';</script>";
  exit;
}
