<?php
include('config.php');
// echo $_GET['product_id'];
if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];
  $sql = "SELECT * FROM link  WHERE id  = '$product_id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_array($result);
  $view = $row['views']+1;
  $update = mysqli_query($connection,"UPDATE link SET views='$view' WHERE id  = '$product_id' ");
  if ($update) {
    // $response = "watched";
    echo $view;
  } else {
      echo json_encode(['error' => 'Product not found']);
  }
}




?>