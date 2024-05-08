<?php

/**
 * @file
 * Handles user registration and database operations.
 */

try {
    // Class for handling user registration
    class UserRegistration
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
         * Register a new user.
         *
         * @param array $userData
         *   Array containing user data (fname, lname, username, password, email).
         *
         * @throws Exception
         *   If registration fails or an error occurs.
         */
        public function registerUser($userData)
        {
            $fname = $userData['fname'];
            $lname = $userData['lname'];
            $fullName = $fname . ' ' . $lname;
            $username = $userData['username'];
            $password = password_hash($userData['password'], PASSWORD_DEFAULT);
            $email = $userData['email'];

            // Check if any field is empty
            if (empty($fname) || empty($lname) || empty($username) || empty($password) || empty($email)) {
                throw new Exception("Please fill in all fields");
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            $this->conn->begin_transaction();
            // Prepare and execute insert query
            $query = "INSERT INTO user (name, username, password, email) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssss", $fullName, $username, $password, $email);
            if (!$stmt->execute()) {
                throw new Exception("Error: " . $stmt->error);
            } else {
                $this->conn->commit();
                $_SESSION['registered'] = true;
                $_SESSION["username"] = $username;
                echo "<script>window.location.href = '../php/home.php';</script>";
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
        session_start();
        // Initialize UserRegistration class
        $userRegistration = new UserRegistration();
        // User data from form
        $userData = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email']
        ];
        // Register the user
        $userRegistration->registerUser($userData);
    }
} catch (Exception $e) {
    // Display error message and redirect to login.php
    echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
    echo "<script>window.location.href = '../php/signup.php';</script>";
    exit;
}
