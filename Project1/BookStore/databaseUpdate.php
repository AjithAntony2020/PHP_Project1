<?php
session_start();
$bookid = $_GET['book'];
require('mysqli_connect.php');



if ($_SERVER['REQUEST_METHOD'] == "POST"){



  $firstname = mysqli_real_escape_string($dbc, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($dbc, $_POST['lastname']);
  $email = mysqli_real_escape_string($dbc, $_POST['email']);
  $phone = mysqli_real_escape_string($dbc, $_POST['phone']);
  $address = mysqli_real_escape_string($dbc, $_POST['address']);

  function insertIntoCustomer($dbc, $firstname, $lastname, $email, $phone, $address)
  {
    $query = "INSERT INTO 
    customer(first_name, last_name, email, phone, `address`)
    VALUES 
    ('" . $firstname . "', '" . $lastname ."', '" . $email . "', '" . $phone . "', '" . $address ."')";
    $result = mysqli_query($dbc, $query);
    if (!$result) {
      echo "4" . mysqli_error($dbc);
      exit;
    }
  }
  
  
  function getCustomerId($dbc, $email)
  {
    $query = "SELECT ID from customer WHERE email = '".$email."'";
    $result = mysqli_query($dbc, $query);
    if ($result && mysqli_num_rows($result) != 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['ID'];
    } else {
      return null;
    }
  }
  
  
  function insertIntoOrder($dbc, $bookid , $customerid)
  {
    $query = "INSERT INTO bookinventoryorder(product_id, customer_id) VALUES 
    ('" . $bookid . "', '" . $customerid ."')";
    $result = mysqli_query($dbc, $query);
    if (!$result) {
      echo "4" . mysqli_error($dbc);
      exit;
    }
  }


  function getQuantity($dbc, $bookid)
  {
    $query = "SELECT quantity from bookinventory WHERE ID = '".$bookid."'";
    $result = mysqli_query($dbc, $query);
    if ($result && mysqli_num_rows($result) != 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['quantity'];
    } else {
      return null;
    }
  }

    
  function updateQuantity($dbc, $bookid)
  {

    $quantity = getQuantity($dbc, $bookid);
    $quantity = $quantity - 1;
    
    $query = "UPDATE bookinventory SET quantity = ". $quantity. " WHERE ID = '".$bookid."'";
    $result = mysqli_query($dbc, $query);
    if (!$result) {
      echo "4" . mysqli_error($dbc);
      exit;
    }
  }


  insertIntoCustomer($dbc, $firstname, $lastname, $email, $phone, $address);
  $customerid = getCustomerId($dbc, $email);
  insertIntoOrder($dbc, $bookid , $customerid);
  updateQuantity($dbc, $bookid);

  echo '<script type="text/javascript">'; 
  echo 'alert("Purchase successfull");'; 
  echo 'window.location.href = "index.php";';
  echo '</script>';

  exit(); 

}



?>