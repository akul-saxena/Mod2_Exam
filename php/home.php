<?php

/**
 * Starts the session and redirects to index.php if user is not registered.
 */
session_start();
if ($_SESSION['registered'] !== true) {
  header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../stylesheets/homestyles.css">
  <title>Welcome</title>
</head>

<body>

  <header>
    <section class="navbar container">
      <nav>
        <a href="../php/homew.php">Home</a>
        <a href="../php/stock-entry.php">Stock Entry</a>
        <a href="../php/logout.php">Logout</a>
      </nav>
    </section>
  </header>

  <main class="container">
    <section class="stocks">
      <h2>Stocks :</h2>
      <section class="stocks-table">

      </section>
    </section>
  </main>

  <script src="../scripts/script.js"></script>

</body>

</html>