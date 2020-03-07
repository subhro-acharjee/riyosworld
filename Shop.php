
<?php
session_start();

 require "Config/config.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Static/css/bootstrap.min.css">
    <link rel="stylesheet" href="Static/css/view.css">
    <link rel="icon" href="Staic/images/icon.png">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Fjalla+One&display=swap" rel="stylesheet">
    <title>Riyo's World</title>
  </head>
  <body class="text-center">
    <div class="text-center">
      <?php   if(!isset($_SESSION['sesid']))
        require "Static/Templates/navbar.html";
        else
        require 'Static/Templates/account_navbar2.html';  ?>
    </div>
    <div class="HEAD">
      <?php require "Static/Templates/header.html"; ?>
    </div>
    <h1 class="display-1 text-style4">Welcome to The Shop</h1>
    <main class="row mx-auto mt-lg-5 pt-lg-5 mb-lg-5 pb-lg-5">
    <?php $query="SELECT * FROM Product LIMIT 20";
    if($res=mysqli_query($con,$query))
    {
      $nor=mysqli_affected_rows($con);
      $query="SELECT * FROM Product ";
      if($res=mysqli_query($con,$query))
      {
        $nor=mysqli_affected_rows($con);
While($values=mysqli_fetch_array($res))
{
  $id=$values['id'];
  $name=$values['name'];
  $link=$values["image link"];
  $description=$values['description'];
  $price=$values['mrp'];
  $qty=$values['qty'];
  ?>


      <div class="col-md-3 mx-auto bg-primary">
        <img src=" <?php echo $link ?> " alt="" width=100%>
        <h1 class="text-style4"> <?php echo $name;?> </h1>
        <h4 class="text-style3"> <?php echo $description ?> </h4>

        <a href="Product.php?prodid=<?php echo $id; ?>" class="btn btn-lg btn-dark" >Buy at &#x20B9;<?php echo $price; ?></a>
      </div>
    <?php }}}?>
  </main>

    </div>
    <div class="Footer mb-0" style="  overflow-x: hidden;bbackground-image:url('/home/subhro/Downloads/photo1.jpg')">
      <?php require "Static/Templates/footer.html"; ?>
    </div>

  </body>
  <script src="Static/js/jquery.js" charset="utf-8"></script>
  <script src="Static/js/bootstrap.min.js" charset="utf-8"></script>
<script src="Static/js/app.js" charset="utf-8"></script>
<script type="text/javascript">
  function logout() {
    $.post("Auth/index.php",{"logout":"logout"},function(){
      window.location.href='index.php';
    });
  }
</script>
</html>
<?php ?>
