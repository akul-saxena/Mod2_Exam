$(document).ready(function () {
  displayStocks();
  //Functuon to display stock using AJAX
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
        loadStocks(stocks);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }
  function loadStocks(stocks) {
    var tableHTML = `
      <table border = "1px solid black";
>
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
