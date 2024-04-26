<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    $conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
    if ($conn->connect_error) {
      throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    } else {
      $stockName = $_POST['stockName'];
      $stockPrice = $_POST['stockPrice'];
      $id = $_POST['stockID'];

      if (empty($stockName) || empty($stockPrice)) {
        throw new Exception("Please fill in all fields");
      }
      date_default_timezone_set('Asia/Kolkata');
      $createdDate = date('Y-m-d H:i:s', time());
      $updatedDate = $createdDate;
      $username = $_SESSION["username"];

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
      if (!$stmt->execute()) {
        throw new Exception("Error: " . $stmt->error);
      } else {
        $conn->commit();
        echo "<script>window.location.href = '../php/home.php';</script>";
        exit;
      }
    }
  } catch (Exception $e) {
    echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
    echo "<script>window.location.href = '../php/stock-entry.php';</script>";
    exit;
  } finally {
    if (isset($conn)) {
      $conn->close();
    }
  }
}
