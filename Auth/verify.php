<?php
session_start();
if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
else if(isset($_GET['aws'])){
  require "../Config/config.php";
  $stmt=mysqli_stmt_init($con);
  if($stmt->prepare("UPDATE customer SET status=? WHERE email=?")){
    $status="active";
    $stmt->bind_param("ss",$status,$_GET['email']);
    $stmt->execute();
  }
  header("location: login.php");
  die(0);
}
else{
  header("location: ../index.php");
  die(0);
}
