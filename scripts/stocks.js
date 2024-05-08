$(document).ready(function () {
  // Call function to display user stocks on page load
  displayUserStocks(username);

  // Function to display user stocks using AJAX
  function displayUserStocks(username) {
    $.ajax({
      url: "../php/fetch-user-stocks.php",
      method: "GET",
      data: { username: username },
      success: function (response) {
        // Parse response data
        var stocks = JSON.parse(response);
        // Check for errors in response
        if (stocks.error) {
          console.error(stocks.error);
          return;
        }
        // Load stocks into table
        loadStocks(stocks);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  // Function to load stocks into HTML table
  function loadStocks(stocks) {
    var tableHTML = `
      <table border = "1px solid black">
        <thead>
          <tr>
            <th>Stock Id</th>
            <th>Stock Name</th>
            <th>Stock Price</th>
            <th>Created Date</th>
            <th>Last Updated</th>
          </tr>
        </thead>
        <tbody>
    `;
    stocks.forEach(function (stock) {
      tableHTML += `
          <tr>
            <td>${stock.id}</td>
            <th>${stock.stock_name}</th>
            <td>${stock.stock_price}</td>
            <td>${stock.created_date}</td>
            <td>${stock.last_updated}</td>
          </tr>
        `;
    });
    tableHTML += `
        </tbody>
      </table>
    `;
    // Insert table HTML into DOM
    $(".stocks-table").html(tableHTML);
  }
});
