<?php

/**
 * @file
 * Starts the session and redirects to index.php if user is not registered.
 */

// Start session
session_start();

// Redirect to index.php if user is not registered
if ($_SESSION['registered'] !== true) {
  header('Location: /');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include custom stylesheet -->
  <link rel="stylesheet" href="../stylesheets/homestyles.css">
  <title>Welcome</title>
</head>

<body>

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

  <main class="container">
    <?php
    $usercap = ucfirst($_SESSION['username']);
    echo "<h1 align='center'>Hello " . $usercap . "</h1><br>";
    ?>
    <section class="stocks">
      <!-- Title -->
      <h2>Stocks :</h2>
      <br><a href="/stock-entry">Add Stock</a><br>
      <br><a href="/edit-user-stock">Edit Stock</a><br>
      <br><a href="/delete-user-stock">Delete Stock</a><br>
      <!-- Table for displaying stocks -->
      <br>
      <section class="stocks-table">
        <!--Data coming from script file (AJAX)-->
      </section>
    </section>
  </main>

  <!-- Include custom JavaScript file -->
  <script src="../scripts/script.js"></script>

</body>

</html>