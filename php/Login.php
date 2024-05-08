<?php

/**
 * Class SessionManager handles session-related operations.
 */
class SessionManager
{
  /**
   * Constructor method to start the session and redirect if the user is already registered.
   */
  public function __construct()
  {
    session_start();
    // Redirect to home.php if the user is already registered
    if ($_SESSION['registered'] == true) {
      header('Location: /home');
      exit; // Stop script execution after redirection
    }
  }
}

// Initialize the session manager
new SessionManager();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css">
</head>

<body>
  <section>
    <form action="../php/logincheck.php" method='post'>
      <h1>Welcome</h1><br>
      <h3>Login:</h3><br>

      <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
      </div><br>

      <div>
        <label for="password">Password </label>
        <input type="password" name="password" id="password" required>
      </div><br>

      <input type="submit" value="Login" name='submit'><br><br>

      <a href="/signup">SignUp</a>
    </form>
  </section>

</body>

</html>