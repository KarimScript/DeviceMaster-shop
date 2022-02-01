<?php

require("includes/connect.php");
session_start();

$email = $_POST['email'];
$email = mysqli_real_escape_string($con, $email);
$password = $_POST['password'];
$password = mysqli_real_escape_string($con, $password);



$query = "SELECT * FROM users WHERE email='" . $email . "' AND password='" . $password . "'";
$result = mysqli_query($con, $query)or die($mysqli_error($con));
$num = mysqli_num_rows($result);

if ($num == 0) {
  $error = $_GET['error'];
  $error = "<span class='red'>Enter Correct E-mail and Password </span>";
  header('location: userLogin.php?error=' . $error);
} else {
  $row = mysqli_fetch_array($result);
  if($row['userType']==1){
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['admin']=$row['userType'];
    header('location:/onlineShop-csci425/online-shop/adminpage.php?page=Manage');
  }
  else{$_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['id'];
    header('location: products.php');}
  
}
?>
