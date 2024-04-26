<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    //Make database Connection
    $conn = mysqli_connect('localhost', 'akul', 'Hariom@339', 'UserData');
    if ($conn->connect_error) {
      throw new Exception('' . $conn->connect_error);
    } else {
      //store values in session Variable
      $username = $_POST['username'];
      $password = $_POST['password'];

      //Query to get pass from database
      $result = mysqli_fetch_array(mysqli_query($conn, "SELECT password FROM user WHERE username = '$username'"));

      if (!$result) {
        throw new Exception("No User Found !! Please check the details, and try again.");
      } else {
        $hashed_password = $result['password'];

        if (!password_verify($password, $hashed_password)) {
          throw new Exception("Invalid Username or password, please try again !!");
        } else {
          $_SESSION['registered'] = true;
          $_SESSION['username'] = $username;
          echo "<script>window.location.href = '../php/home.php';</script>";
        }
      }
    }
  } catch (Exception $e) {
    echo "<script>alert('Ooops : " . addslashes($e->getMessage()) . "');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
  }
}