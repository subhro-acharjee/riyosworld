<?php
session_start();
if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
else if(isset($_POST['forget'])){
  require '../Config/config.php';
  $password=md5($_POST['password']);
  $email=$_POST['forget'];
  $stmt=mysqli_stmt_init($con);
  if($stmt->prepare('UPDATE customer SET password=? WHERE email=?')){
    $stmt->bind_param("ss",$password,$email);
    if($stmt->execute()){
      header("location: login.php");
      die(0);
    }
    else{
      header("location: ../index.php");
      die(0);
    }
  }
  else{
    header("location: ../index.php");
    die(0);
  }
}
