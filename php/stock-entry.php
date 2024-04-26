<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Starts the session and redirects to index.php if user is not registered.
 */
session_start();
if ($_SESSION['registered'] !== true) {
  header('Location: /index.php');
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
      <nav>
        <a href="../php/home.php">Home</a>
        <a href="../php/stock-entry.php">Stock Entry</a>
        <a href="../php/logout.php">Logout</a>
      </nav>
    </section>
  </header>
  <main class="container">
    <!--Stock entry form-->
    <section class="form-container">
      <form action="../php/stock-entry-check.php" class="stocks" method="post">
        <h3>Stock Details</h3>
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
      </section>
      <!--Link to edit stocks-->
      <a href="edit-user-stock.php">Edit Stocks</a>
    </section>
    <br><br><a href="home.php">Go back to Home Page</a>
  </main>
  <script>
    var username = "<?php echo $_SESSION['username'] ?>";
  </script>
  <script src="../scripts/stocks.js"></script>

</body>

</html>