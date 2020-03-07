<?php session_start();
require 'Config/config.php';
if(!isset($_GET['prodid'])){
  header("location: index.php");
  die(0);
}
else{
  $id=$_GET['prodid'];
  $stmt=mysqli_stmt_init($con);
  if($stmt->prepare("SELECT * FROM Product WHERE id=?")){
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $res=$stmt->get_result();
    if(mysqli_affected_rows($con)==0){
      header("location: index.php");
      die(0);
    }
    else{

      if(!($row=mysqli_fetch_assoc($res))){
        header("location: index.php");
        die(0);
      }
      else{
        $product=$row['name'];
        $price=(float)$row['mrp'];
        $discount=(float)$row['discount'];
        $description=$row['description'];
        $link=$row['image link'];
        $qty=(int)$row['qty'];
        $dis=ceil( $price-($price*$discount));
        $_SESSION['price']= base64_encode( $dis);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Static/css/bootstrap.min.css">
    <link rel="stylesheet" href="Static/css/view.css">
    <link rel="icon" href="Staic/images/icon.png">
    <title>Riyo's World</title>
  </head>
  <body>
    <div class="row justify-content-center mb-lg-5" id="product" >
      <div class="col-md-12 jumbotron green-back">

      </div>
      <div class="col-md-3">
        <img src=" <?php echo $link; ?> " alt="" width=100%>
      </div>
      <div class="col-md-4">
        <h1 class="display-4 font-5"> <?php echo $product; ?> </h1>
        <h3>Description:</h3>
        <p class=" font-14" > <?php echo $description; ?> </p>
        <h3>Price: <?php echo $price; ?> </h3>

      <?php if($qty<25): ?>
        <div class="alert alert-danger">
          <h2 class="text-style4">Out Of Stock</h2>
        </div>
      <?php else: ?>
        <?php if(isset($_SESSION['id'])){
          if($stmt->prepare("SELECT * FROM customer WHERE customerid=?")){
            $stmt->bind_param("i",$_SESSION['id']);
            $stmt->execute();
            if(mysqli_affected_rows($con)==0){
              echo "<script>window.location.href='index.php'</script>";

            }
            else{
              $res=$stmt->get_result();
              if(!($row=mysqli_fetch_assoc($res))){
                echo "<script>window.location.href='index.php'</script>";
              }
              else{
                $user_name=$row['fname']." ".$row['lname'];
                $email=$row['email'];
                $phone=$row['phoneno'];


        ?>
        <div class="btn-group">
          <form method="post" action="Pay/index.php">
            <input type="text" name="address" value="" class="form-control mx-0" placeholder="Address..." width=100% required>
            <input type="text" name="city" value="" class="form-control mx-0" placeholder="PIN" width=100% required>
            <select class="form-control" name="State"  required>
              <option value="cant">STATE</option>
              <option value="MAHARASTRA">Maharahastra</option>
              <option value="MP">Madhya Pradesh</option>
              <option value="UP">Utter Pradesh</option>
              <option value="WB" selected>West Bengal</option>

            </select>
            <input type="hidden" name="name" value="<?php echo $user_name; ?>">
            <input type="hidden" name="email" value="<?php echo $email ?>">
            <input type="hidden" name="phone" value="<?php echo $phone ?>">
            <input type="hidden" name="product" value="<?php echo $product ?>">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="link" value="<?php echo $link ?>">
              <button type="submit" name="buy" class="btn btn-lg btn-secondary">Buy @ <?php echo $dis?> </button>
          </form>

        </div>
        <?php }
      }
    }
  }
  else{
    $_SESSION['redirect']=retDom().$_SERVER['REQUEST_URI'];
   ?>
   <p class=""> You Need to log In to Buy the product.</p>
   <div class="form-group" >

     <a href="Auth/login.php" class="btn btn-lg btn-primary form-control">Login</a>
   </div>
 <?php }?>
      <?php endif; ?>
      </div>
    </div>

  </body>
  <script src="Static/js/jquery.js" charset="utf-8"></script>
  <script src="Static/js/bootstrap.min.js" charset="utf-8"></script>
  <script src="Static/js/app.js" charset="utf-8"></script>
  <script type="text/javascript">

  </script>

</html>


<?php   }
}
}
}?>
