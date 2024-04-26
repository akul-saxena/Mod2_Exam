$(document).ready(function () {
  displayUserStocks(username);
  //Function to display user stocks using ajax
  function displayUserStocks(username) {
    $.ajax({
      url: "../php/fetch-user-stocks.php",
      method: "GET",
      data: { username: username },
      success: function (response) {
        var stocks = JSON.parse(response);
        if (stocks.error) {
          console.error(stocks.error);
          return;
        }
        loadStocks(stocks);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }
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
            <td>${stock.stock_name}</td>
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
    $(".stocks-table").html(tableHTML);
  }
});
