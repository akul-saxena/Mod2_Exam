<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    //Database connection
    $conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
    if ($conn->connect_error) {
      throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    } else {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $fullName = $fname . ' ' . $lname;
      $username = $_POST['username'];
      $password = $_POST['password'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $email = $_POST['email'];
      //Check if fields are empty
      if (empty($fname) || empty($lname) || empty($username) || empty($password) || empty($email)) {
        throw new Exception("Please fill in all fields");
      }
      //email format validation
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
      }

      $conn->begin_transaction();
      //Insert query for signup
      $query = "INSERT INTO user (name, username, password, email) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($query);
      //sql injections
      $stmt->bind_param("ssss", $fullName, $username, $password, $email);
      if (!$stmt->execute()) {
        throw new Exception("Error: " . $stmt->error);
      } else {
        $conn->commit();
        $_SESSION['registered'] = true;
        $_SESSION["username"] = $username;
        echo "<script>window.location.href = '../php/home.php';</script>";
        exit;
      }
    }
  } catch (Exception $e) {
    echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
    //Redirect to login
    echo "<script>window.location.href = '../php/login.php';</script>";
    exit;
  } finally {
    if (isset($conn)) {
      $conn->close();
    }
  }
}
