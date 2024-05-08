<?php

/**
 * @file
 * Handles user login and session management.
 */

// Initialize session
session_start();

try {
  // Class for handling user authentication
  class UserAuthentication
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
     * Authenticate user based on provided credentials.
     *
     * @param string $username
     *   The username provided by the user.
     * @param string $password
     *   The password provided by the user.
     *
     * @throws Exception
     *   If authentication fails or an error occurs.
     */
    public function authenticateUser($username, $password)
    {
      // Query to get password hash from database
      $query = "SELECT password FROM user WHERE username = '$username'";
      $result = mysqli_fetch_array(mysqli_query($this->conn, $query));

      if (!$result) {
        throw new Exception("No User Found !! Please check the details and try again.");
      } else {
        $hashed_password = $result['password'];

        // Verify password
        if (!password_verify($password, $hashed_password)) {
          throw new Exception("Invalid Username or password, please try again !!");
        } else {
          // Set session variables upon successful authentication
          $_SESSION['registered'] = true;
          $_SESSION['username'] = $username;
          echo "<script>window.location.href = '/home';</script>";
        }
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
    // Initialize UserAuthentication class
    $authenticator = new UserAuthentication();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user
    $authenticator->authenticateUser($username, $password);
  }
} catch (Exception $e) {
  // Display error message and redirect to login
  echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
  echo "<script>window.location.href = '/login';</script>";
}
