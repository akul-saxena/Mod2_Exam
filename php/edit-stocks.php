<?php

/**
 * @file
 * Contains the Database class for handling database connections.
 */

/**
 * Database class for managing database connections.
 */
class Database
{
  private $conn;

  /**
   * Constructor method.
   */
  public function __construct()
  {
    $this->conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
    if ($this->conn->connect_error) {
      throw new Exception('Failed to connect to database: ' . $this->conn->connect_error);
    }
  }

  /**
   * Get the database connection.
   *
   * @return object
   *   The database connection object.
   */
  public function getConnection()
  {
    return $this->conn;
  }

  /**
   * Close the database connection.
   */
  public function closeConnection()
  {
    $this->conn->close();
  }
}

/**
 * @file
 * Contains the StockUpdater class for handling stock entry updates.
 */

/**
 * StockUpdater class for updating stock entries.
 */
class StockUpdater
{
  private $db;

  /**
   * Constructor method.
   *
   * @param Database $db
   *   The Database object for database operations.
   */
  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  /**
   * Update stock entries.
   */
  public function updateStock()
  {
    session_start();
    try {
      $conn = $this->db->getConnection();

      $stockName = $_POST['stockName'];
      $stockPrice = $_POST['stockPrice'];
      $id = $_POST['stockID'];
      $username = $_SESSION["username"];

      if (empty($stockName) || empty($stockPrice)) {
        throw new Exception("Please fill in all fields");
      }

      date_default_timezone_set('Asia/Kolkata');
      $createdDate = date('Y-m-d H:i:s', time());
      $updatedDate = $createdDate;

      $conn->begin_transaction();
      $query = "UPDATE stock_entries SET stock_name = ?, stock_price = ? WHERE id = ? AND username = ?";
      $stmt = $conn->prepare($query);
      if (!$stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
      }
      $stmt->bind_param("ssis", $stockName, $stockPrice, $id, $username);
      if (!$stmt->execute()) {
        throw new Exception("Error executing statement: " . $stmt->error);
      }

      $conn->commit();
      echo "<script>window.location.href = '/home';</script>";
      exit;
    } catch (Exception $e) {
      echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
      echo "<script>window.location.href = '/stock-entry';</script>";
      exit;
    } finally {
      $this->db->closeConnection();
    }
  }
}

if (isset($_POST["submit"])) {
  $db = new Database();
  $stockUpdater = new StockUpdater($db);
  $stockUpdater->updateStock();
}
