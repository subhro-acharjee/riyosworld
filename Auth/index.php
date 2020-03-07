<?php
session_start();
if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
require "../Config/config.php";

if(!isset($_POST['email'])){
header("location: ../index.php");
die(0);
}
else{
$email=$_POST['email'];
$query="SELECT * FROM customer WHERE email = ?";
$stmt=mysqli_stmt_init($con);
if(mysqli_stmt_prepare($stmt,$query)){
  mysqli_stmt_bind_param($stmt,"s",$email);
  if(mysqli_stmt_execute($stmt)){
    $res=mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($res)>0){
      $otp=rand(10000,99999);
      $stmt=mysqli_stmt_init($con);

      if(mysqli_stmt_prepare($stmt,"SELECT otp FROM otp WHERE otp=?")){
        mysqli_stmt_bind_param($stmt,"i",$otp);
        mysqli_stmt_execute($stmt);
        $res=mysqli_stmt_get_result($stmt);
        if(mysqli_affected_rows($con)>0){
          if(mysqli_stmt_prepare($stmt,"UPDATE otp SET email=?, status=? WHERE otp=?")){
            $status=1;
            mysqli_bind_param($stmt,"si",$email,$status);
            if(mysqli_stmt_execute($stmt)){
              SendOTP($email,$otp);
            }
            else{
              echo 1;
            }
          }
        }
        else{
          $status=0;
          if(mysqli_stmt_prepare($stmt,"INSERT INTO otp(otp,status,email) VALUES(?,?,?)")){
            mysqli_stmt_bind_param($stmt,"iis",$otp,$status,$email);
            if(mysqli_stmt_execute($stmt)){
              SendOTP($email,$otp);
            }
          }
        }
      }

    }
    else{
    echo "Email Doesn't exists";
    }
  }
}

}
