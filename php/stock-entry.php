<?php

/**
 * @file
 * Handles stock entry and redirects if user is not registered.
 */

try {
  // Class for handling user session
  class SessionManager
  {
    /**
     * Constructor method to start the session and redirect if user is not registered.
     */
    public function __construct()
    {
      session_start();
      if ($_SESSION['registered'] !== true) {
        header('Location: /index.php');
        // Exit after redirecting
        exit;
      }
    }
  }

  // Initialize the session manager
  new SessionManager();
} catch (Exception $e) {
  // Display error message and redirect to index.php
  echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
  echo "<script>window.location.href = '/index.php';</script>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Stock Entry</title>
  <link rel="stylesheet" href="../stylesheets/stockentrystyles.css">
</head>

<body>
  <!--Navbar-->
  <header>
    <section class="navbar container">
      <div class='nav-left'>
        <!-- Navigation links -->
        <a href="../php/home.php">Home</a>
        <a href="../php/stock-entry.php">Stock Entry</a>
      </div>
      <div class='nav-right'>
        <a href="../php/logout.php">Logout</a>
      </div>
    </section>
  </header>
  <main class="container">
    <?php
    $usercap = ucfirst($_SESSION['username']);
    echo "<h1 align='center'>Hello " . $usercap . "</h1><br>";
    ?>
    <!--Stock entry form-->
    <section class="form-container">
      <form action="../php/stock-entry-check.php" class="stocks" method="post">
        <h3>Add Stock</h3>
        <div>
          <label for="stockName">Enter Stock Name :</label>
          <input type="text" name="stockName" id="stockName" placeholder="Stock Name">
        </div>
        <div>
          <label for="stockPrice">Enter Stock Price : </label>
          <input type="text" name="stockPrice" id="stockPrice" placeholder="Stock Name">
        </div>
        <input type="submit" value="Add Stock" name="submit">
      </form>
    </section>
    <section class="userStocks">
      <h2>Here are your stocks:</h2>
      <section class="stocks-table">
        <!--Entries from script file-->
      </section><br>
      <!--Link to edit stocks-->
      <a href="edit-user-stock.php">Edit Stocks</a><br>
      <br><a href="../php/delete-user-stock.php">Delete Stock</a><br>
    </section>
    <br><a href="home.php">Go back to Home Page</a>
  </main>
  <script>
    var username = "<?php echo $_SESSION['username'] ?>";
  </script>
  <script src="../scripts/stocks.js"></script>

</body>

</html>