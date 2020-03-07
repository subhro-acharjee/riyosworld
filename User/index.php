<?php
session_start();
if(!isset($_SESSION['sesid'])){
  header("location: ../index.php");
  die(0);
}
else{
  $id=$_SESSION['id'];
if(isset($_POST['logout'])){
  session_destroy();
  header("location:../index.php");
  die(0);
}
require '../Config/config.php';
$stmt=mysqli_stmt_init($con);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Static/css/view.css">
    <link rel="icon" href="../Staic/images/icon.png">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Fjalla+One&display=swap" rel="stylesheet">
    <title>Riyo's World</title>
  </head>
  <body>
    <header>
      <?php require '../Static/Templates/account_navbar.html';
      require '../Static/Templates/header.html';
      ?>
    </header>
    <main class="row">
      <section class="col-md-6 ml-lg-5 border border-primary mb-lg-5 text-center">
        <h2 class="display-4 text-style4">Your Previous Orders</h2>
        <ul class="list-group list-group-flush ml-lg-5 ">
          <?php if($stmt->prepare("SELECT * FROM order_history WHERE customerid=? AND status=? LIMIT ?")){
            $status="done";
            $lim=20;
            $stmt->bind_param("isi",$id,$status,$lim);
            $stmt->execute();
            $result=$stmt->get_result();
            if(mysqli_affected_rows($con)==0){
              echo "Nothing To show";
            }
            else{
              while($row=mysqli_fetch_assoc($result)){
                $order=$row['product name'];
                $orderid=$row['orderid'];
                $eta=$row['DOO'];
                echo "<li class='list-group-item'>
                <div class='card'>
                <div class='card-header'>Product Name <h2>$order</h2> </div>
                <div class='card-body'>Order ID <h2>$orderid</h2> </div>
                <div class='card-footer'>Ordered on <h2>$eta</h2> </div>
                </div>
                </li>";
              }
            }
          }
          else{
            echo "error";
          } ?>
        </ul>
      </section>
      <section class="col-md-4 text-center mb-lg-5 border border-primary ml-lg-3">
        <?php
        if($stmt->prepare("SELECT * FROM customer WHERE customerid=?")){
          $stmt->bind_param("i",$id);
          $stmt->execute();
          $res=$stmt->get_result();
          while($row=mysqli_fetch_assoc($res)){
            $fname=$row['fname'];
            $lname=$row['lname'];
            $address=$row['address'];
            $phone=$row['phoneno'];
            $email=$row['email'];

         ?>
         <h2>Your details</h2>
        <div class="card">
          <div class="card-header">
            <h3 class="text-style1"> Name: <?php echo $fname." ".$lname; ?> </h3>
          </div>
          <div class="card-body">
            <h4 class="text-style1">Address: <?php echo $address; ?> </h4>
          </div>
          <div class="card-footer">
            <h4 class="text-style1">Phone Number: <?php echo $phone; ?> </h4>
          </div>
        </div>
        <div class="btn-group">
          <button type="button" name="button" onclick="$('#chg-add').toggle();$('#chg-phn').hide();" class="btn btn-lg btn-primary mt-lg-2 mb-lg-3">Change address</button>
            <button type="button" name="button" onclick="$('#chg-phn').toggle();$('#chg-add').hide()" class="btn btn-lg btn-primary mt-lg-2 mb-lg-3">Change PhoneNo</button>
        </div>
        <div id="chg-add" style="display:none">
          <form class="form-group" method="post">
            <h2 class="from-control">Change address</h2>
            <textarea name="address" rows="8" cols="80" class="form-control" placeholder="Address..."></textarea>
            <button type="submit" name="button" class="btn btn-lg btn-secondary">Change</button>
          </form>
        </div>
        <div id="chg-phn" style="display:none">
          <form class="form-group" method="post">
            <h2 class="from-control">Change Phone Number</h2>
            <input type="text" name="phno" value="" class="form-control" placeholder="Phone number...">
            <button type="submit" name="button" class="btn btn-lg btn-secondary">Change</button>
          </form>
        </div>
        <?php }} ?>

      </section>

    </main>
    <footer>
      <?php
      require '../Static/Templates/account_footer.html';
      ?>
    </footer>
  </body>
  <script src="../Static/js/jquery.js" charset="utf-8"></script>
  <script src="../Static/js/bootstrap.min.js" charset="utf-8"></script>
  <script src="../Static/js/app.js" charset="utf-8"></script>
  <script type="text/javascript">
    function logout() {
      $.post("index.php",{"logout":"logout"},function(){
        window.location.href='../index.php';
      });
    }
  </script>
</html>
<?php
if(isset($_POST['address'])){
  if($stmt->prepare('UPDATE customer set address=? WHERE customerid=?')){
    $stmt->bind_param("si",$_POST['address'],$id);
    if($stmt->execute()){
      echo "<script>alert('success');</script>";
    }
  }
}
if(isset($_POST['phno'])){
  if($stmt->prepare('UPDATE customer set phoneno=? WHERE customerid=?')){
    $stmt->bind_param("si",$_POST['phno'],$id);
    if($stmt->execute()){
      echo "<script>alert('success');</script>";
    }
  }
}


}?>
