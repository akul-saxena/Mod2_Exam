$(document).ready(function () {
  // Function to display stocks using AJAX
  displayStocks();

  // Function to fetch and display stocks using AJAX
  function displayStocks() {
    $.ajax({
      url: "../php/fetch-stocks.php",
      method: "GET",
      success: function (response) {
        var stocks = JSON.parse(response);
        if (stocks.error) {
          console.error(stocks.error);
          return;
        }
        console.log(stocks);
        // Call the function to load stocks into the HTML table
        loadStocks(stocks);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  // Function to load stocks into the HTML table
  function loadStocks(stocks) {
    var tableHTML = `
      <table border="1px solid black">
        <thead>
          <tr>
            <th>Stock Id</th>
            <th>Owner</th>
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
            <td>${stock.username}</td>
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
    // Render the HTML table with stock data
    $(".stocks-table").html(tableHTML);
  }
});
