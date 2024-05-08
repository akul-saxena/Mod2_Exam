<?php

/**
 * @file
 * Starts the session and redirects to home.php if user is registered.
 */

// Start session
session_start();

// Redirect to home.php if user is already registered
if ($_SESSION['registered'] == true) {
  header('Location: ../php/home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css">
</head>

<body>
  <section>
    <section>
      <form action="/php/signupcheck.php" method='post' id='myForm'>
        <h1 id="page-heading">Sign Up</h1>
        <div>
          <label for="fname">Firstname:</label>
          <input type="text" name="fname" id="fname" required>
        </div>
        <div>
          <label for="lname">Lastname:</label>
          <input type="text" name="lname" id="lname">
        </div>
        <div>
          <label for="username">Username:</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required>
        </div>
        <div>
          <label for="password">Confirn Password:</label>
          <input type="password" name="password" id="repassword" required>
        </div>
        <span id="passwordError" style="color: red; display: none;">Passwords do not match!</span>
        <div>
          <label for="email">E-mail: </label>
          <input type="email" name="email" id="email">
        </div><br>
        <input type="submit" value="Sign Up" name='submit'><br><br>
        <a href="../index.php">Login </a>
      </form>
    </section>
  </section>
  <script src="../scripts/signup.js"></script>

</body>

</html>