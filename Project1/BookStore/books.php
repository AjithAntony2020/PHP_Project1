<?php
  session_start();
  $title = "All Books";
  $count = 0;

  include('./template/header.php');
  require('mysqli_connect.php');

  $query = "SELECT ID, name FROM bookinventory WHERE quantity != 0 ORDER BY ID DESC";
  $result = mysqli_query($dbc, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_reror($dbc);
    exit;
  }
?>
  <p class="lead text-center text-muted">Select a book to purchase!</p>
    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="checkout.php?book=<?php setcookie($query_row['ID'], $query_row['name'], time()+2*24*60*60);echo $query_row['ID'];?>">
              <img class="img-responsive img-thumbnail mb-5" src="./image/<?php echo $query_row['name']; ?>.jpg">
            </a>
          </div>
        <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?> 
      </div>
<?php
      }
  if(isset($dbc)) { mysqli_close($dbc); }
  include('./template/footer.php');
?>