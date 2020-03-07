<?php
session_start();
if(!isset($_SESSION['sesid'])){
  header("location: ../index.php");
  die(0);
}
require '../Config/config.php';
$stmt=mysqli_stmt_init($con);
if(!isset($_POST['buy'])&&!isset($_GET['payment_id'])&&!isset($_SESSION['sessid'])){
  header("location: ../index.php");
  die(0);
}
else if(isset($_POST['buy'])){
  $address=$_POST['address']." ".$_POST['city']." ".$_POST['State'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $product=$_POST['product'];
  $qty=1;

  $link=$_POST['link'];
  $customid=$_SESSION['id'];
  $status="going";
  $ETA=date("y-m-d",strtotime("+1 Week"));
  $proid=$_POST['id'];
  $price=base64_decode($_SESSION['price']);
  $url=requestPayment($product,$price,$name,$email,$phone);

  if($stmt->prepare("INSERT INTO `order_history` ( `product name` , `ETA`, `customerid`, `product_id`,`transaction_id`, `Address_of_delivery`, `qty`, `status`, `Image`) VALUES ( ?, ?,?, ?,? ,?, ?, ?, ?) ")&&($current=date("y-m-d h:m:s"))){
    try{
    $stmt->bind_param("ssiississ",$product,$ETA,$_SESSION['id'],$proid,$status,$address,$qty,$status,$link);
    if($stmt->execute()){
      if($stmt->prepare("SELECT orderid FROM order_history WHERE transaction_id=? AND customerid=?")){
        $status="going";
        $stmt->bind_param("si",$status,$_SESSION['id']);
        $stmt->execute();
        $res=$stmt->get_result();
        $row=mysqli_fetch_assoc($res);
        $_SESSION['oid']=$row['orderid'];

      }
      if(setcookie("productId",$proid,time()+9999999)){
        echo "<script>alert('Working')</script>";
      }
      echo $_COOKIE['productId'];
    header("location: ".$url);
    }
    else{
      header("location: payment_error.php?error=DATABASE+CONNECTION+FAILED+1");
      die(0);
    }
    $stmt->execute();}
    catch(Execption $e){
      echo $e;
    }
  }
  else{
    header("location: payment_error.php?error=DATABASE+CONNECTION+FAILED+2");
    die(0);
  }

}
else if(isset($_GET['payment_id'])){
  header("Refresh:7; url=../index.php");
  $qw="";
  //$oid=$_SESSION['oid'];
  if(isset($_COOKIE['productId'])){
    echo "<script>alert('')</script>";
  }
  if(!strcmp($_GET['payment_status'],"Failed")){
    if($stmt->prepare("DELETE FROM order_history WHERE transaction_id=? AND customerid=?")){
      $status2="going";
      $stmt->bind_param("si",$status2,$_SESSION['id']);
      $stmt->execute();
    }
    header("Refresh:5; url= ../index.php");
  $qw="<h1 class='display-1 text-danger'>Your Payment Failed</h1>";

  }
  else{
    $qw="<h1 class='display-1 text-success'> Thank You</h1>";
    if($stmt->prepare("UPDATE order_history SET transaction_id=?,status=? WHERE transaction_id=? AND customerid=?")){
      $txnid=$_GET['payment_id'];
      $status="pending";
      $status2="going";
      $stmt->bind_param('sssi',$txnid,$status,$status2,$_SESSION['id']);
      $stmt->execute();
    }
    
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Static/css/view.css">
    <link rel="icon" href="../Staic/images/icon.png">
    <title>Riyo's World</title>
  </head>
  <body class="row justify-content-center">
    <div class="col-md-6">
      <?php echo $qw ?>
      <hr>
      <table class="table table-border">
        <th> Payment ID</th>
        <td> <?php echo $_GET['payment_id'] ?> </td>


      </table>
    </div>
  </body>
  <script src="../Static/js/jquery.js" charset="utf-8"></script>
  <script src="../Static/js/bootstrap.min.js" charset="utf-8"></script>
  <script src="../Static/js/app.js" charset="utf-8"></script>
</html>

<?php } ?>
