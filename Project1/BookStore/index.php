<?php
session_start();

$title = "Home";
include('./template/header.php');
require('mysqli_connect.php');
?>

      <div class="flex-center">
        <h2>Welcome to Uptown Books</h2>
        <img class="img-responsive img-thumbnail author-img mb-5" src="./image/homeImage.jpg">
        <p><b>A one stop store to grab the book you want at the best price and quality. A collection of books that span across all genres and from the best of authors</p>
      </div>

<?php
include('./template/footer.php');
?>