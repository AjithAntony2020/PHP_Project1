<?php
session_start();
$ID = $_GET['book'];
if(isset($_COOKIE[$ID])){
  $name = $_COOKIE[$ID];
}
require('mysqli_connect.php');

$query = "SELECT * FROM bookinventory WHERE bookinventory.name = '".$name."'" ;
$result = mysqli_query($dbc, $query);

if (!$result) {
  echo "Can't retrieve data " . mysqli_error($dbc);
  exit;
}

$row = mysqli_fetch_assoc($result);
$bookid = $row['ID'];
if (!$row) {
  echo $name;
  echo "No books!";
  exit;
}

$title = $row['name'];
include('./template/header.php');
?>
<div class="coloumn">
<h2>Book Information</h2>
  <div class="flex-center">
    <img class="img-responsive img-thumbnail mb-4" width="200px" height="300px" src="./image/<?php echo $row['name']; ?>.jpg">
    <h3>Book Title</h3>
    <p><?php echo $row['name']; ?></p>
    <h3>Book Description</h3>
    <p><?php echo $row['description']; ?></p>
    <h3>Book Details</h3>
    <table style="width: 20em;" class="table">
      <?php 
      $tableHeadArray = [
        "ID" => "ISBN",
        "name" => "Title",
        "author" => "Author",
        "price" => "Price",
        "quantity" => "Quantity"
      ];
      foreach ($row as $key => $value) {
        if ($key == "description" || $key == "name") {
          continue;
        }
        $key = $tableHeadArray[$key];
      ?>
        <tr>
          <th><?php echo $key; ?></th>
          <td><?php echo $value; ?></td>
        </tr>
      <?php
      }
      if (isset($dbc)) {
        mysqli_close($dbc);
      }
      ?>
    </table>

  </div>
  <br>
  <h2>Customer Information</h2>
  <div class="flex-center">
    <form id="basic-form" method="post" action="databaseUpdate.php?book=<?php echo $bookid ?>" class="form-horizontal">
		<div class="form-group">
			<label for="name" class="control-label">First Name</label>
			<div >
				<input type="text" name="firstname" placeholder="First Name" class="form-control" required>
			</div>
		</div>

		<div class="form-group">
			<label for="name" class="control-label">Last Name</label>
			<div >
				<input type="text" name="lastname" placeholder="Last Name" class="form-control" required>
			</div>
		</div>
    <div class="form-group">
			<label for="email" class="control-label">Email</label>
			<div >
				<input type="text" name="email" placeholder="Email" class="form-control" required>
			</div>
		</div>
    <div class="form-group">
			<label for="phone" class="control-label">Phone</label>
			<div >
				<input type="text" name="phone" placeholder="Phone" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label for="address" class="control-label">Address</label>
			<div>
      ​<textarea id="address" name="address" rows="10" cols="50" class="form-control" required></textarea>
			</div>
		</div>
		<div class="form-group">
     <label for="paymentmethod">Payment method:</label>
     <select name="Payment method" id="paymentmethod">
     <option value="volvo">Card</option>
     <option value="saab">Cash on delivery</option>
     <option value="mercedes">Online banking</option>
     </select>
		</div>

		<div class="form-group">
			<div>
			</div>
			<div>
				<input type="submit" name="submit" value="Purchase" class="btn btn-warning">
			</div>
			<div>
			</div>
		</div>
	</form>
    </div>
</div>
<?php
include('./template/footer.php');
?>