<?php
// Setting error reporting and displaying errors.
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Class SessionManager for handling session operations.
 */
class SessionManager
{
  /**
   * Constructor method to start the session and redirect if user is not registered.
   */
  public function __construct()
  {
    session_start();
    if ($_SESSION['registered'] !== true) {
      header('Location: /');
      exit; // Exit after redirecting
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
  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Edit User Stock</title>
  <!-- Include custom stylesheet -->
  <link rel="stylesheet" href="../stylesheets/stockentrystyles.css">
</head>

<body>
  <!-- Header section -->
  <header>
    <section class="navbar container">
      <div class='nav-left'>
        <!-- Navigation links -->
        <a href="/home">Home</a>
        <a href="/stock-entry">Stock Entry</a>
      </div>
      <div class='nav-right'>
        <a href="../php/logout.php">Logout</a>
      </div>
    </section>
  </header>
  <!-- Main content -->
  <main class="container">
    <?php
    $usercap = ucfirst($_SESSION['username']);
    echo "<h1 align='center'>Hello " . $usercap . "</h1><br>";
    ?>
    <!-- Form section -->
    <section class="form-container">
      <form action="../php/edit-stocks.php" class="stocks" method="post">
        <!-- Form title -->
        <h3>Edit stocks:</h3>
        <!-- Input fields -->
        <div>
          <label for="stockID">Enter stock id :</label>
          <input type="text" name="stockID" id="stockID" placeholder="Stock ID">
        </div>
        <div>
          <label for="stockName">Edit Stock Name :</label>
          <input type="text" name="stockName" id="stockName" placeholder="Stock Name">
        </div>
        <div>
          <label for="stockPrice">Edit Stock Price : </label>
          <input type="text" name="stockPrice" id="stockPrice" placeholder="Stock Name">
        </div>
        <!-- Submit button -->
        <input type="submit" value="Edit Stock" name="submit">
      </form>
    </section>
    <!-- User stocks section -->
    <section class="userStocks">
      <h2>Here are your stocks:</h2>
      <!-- Table for displaying user stocks -->
      <section class="stocks-table">
        <!-- Data coming from AJAX -->
      </section>
      <br><a href="/stock-entry">Add Stock</a><br>
      <br><a href="/delete-user-stock">Delete Stock</a><br>
    </section>
    <!-- Back to home page link -->
    <br><a href="/home">Go back to Home Page</a>
  </main>
  <script>
    // Passing username to JavaScript
    var username = "<?php echo $_SESSION['username'] ?>";
  </script>
  <script src="../scripts/stocks.js"></script>

</body>

</html>