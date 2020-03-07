<?php
session_start();
if(!isset($_SESSION['sesid'])){
  header("../index.php");
  die(0);
}
else{
  $id=$_SESSION['id'];
  require '../Config/config.php';
  $stmt=mysqli_stmt_init($con);
  if(isset($_POST['cancel'])){
    $order=$_POST['cancel'];
    if($stmt->prepare('DELETE FROM order_history WHERE order_history.orderid=?')){

      $stmt->bind_param("i",$order);
      if($stmt->execute()){
        $email="";
        if($stmt->prepare("SELECT email FROM customer WHERE customerid=?")){
          $stmt->bind_param("i",$id);
          $stmt->execute();
          $res=$stmt->get_result();
          $row=mysqli_fetch_assoc($res);
          $email=$row['email'];
        }
        Order_Canceled($email,$id,$order);
      }
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
      <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Fjalla+One&display=swap" rel="stylesheet">
      <title>Riyo's World</title>
    </head>
    <body>
      <header>
        <?php require '../Static/Templates/account_navbar.html';
        require '../Static/Templates/header.html';
        ?>
      </header>

      <main class="row text-center justify-content-center mb-lg-5">
        <?php if($stmt->prepare("SELECT * FROM order_history WHERE customerid=? AND status=? ORDER BY DOO")){
          $status="pending";
          $stmt->bind_param("is",$id,$status);
          $stmt->execute();
          $res=$stmt->get_result();
          if(mysqli_affected_rows($con)!=0){
            echo  '<h2 class="text-style4 col-md-12 display-3">Your Pending Orders</h2><br>';
            while($row=mysqli_fetch_assoc($res)){
              echo '
              <div class="col-md-5">
              <div class="media bg-warning">
              <img src="'.$row['Image'].'" class="mr-3" width=100%>
              <div class="media-body">
              <h2 class="mt-0">'.$row['product name'].'</h2>
              <p>
              Will be delivered by:'.$row['ETA'].'</p>
              <form class="btn-group" method="post">
              <input type="hidden" name="cancel"  value="'.$row['orderid'].'">
              <button type="submit" class="btn btn-lg btn-secondary" >Cancel</button>
              </form>
              </div>
              </div>
              </div>
              ';
            }
          }
    }
    if($stmt->prepare("SELECT * FROM order_history WHERE customerid=? AND status=?")){
      $status="done";
      $stmt->bind_param("is",$id,$status);
      $stmt->execute();
      $res=$stmt->get_result();
      echo "<h2 class='display-3 col-md-12'>Your Previous Orders</h2>
        <ul class='list-group list-group-flush ml-lg-5 col-md-4 '>
      ";

      if(mysqli_affected_rows($con)==0){
        echo "Nothing to Show";
      }
      else{
        while($row=mysqli_fetch_assoc($res)){
          $order=$row['product name'];
          $orderid=$row['orderid'];
          $eta=$row['DOO'];
          $img=$row['Image'];
          echo "<li class='list-group-item'>
          <div class='card bg-success'>
          <img src='$img' class='card-image-top' width=100%>
          <div class='card-header'>Product Name <h2>$order</h2> </div>
          <div class='card-body'>Order ID <h2>$orderid</h2> </div>
          <div class='card-footer'>Ordered on <h2>$eta</h2> </div>
          </div>
          </li>";
      }
      echo "</ul>";

    }
}
         ?>
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
}
?>
