
<?php
session_start();
if(isset($_SESSION['sesid'])){
  header("location: User/index.php");
  die(0);
}
require "Config/config.php";
?>
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
      <?php require "Static/Templates/navbar.html";  ?>
    </div>
    <div class="HEAD">
      <?php require "Static/Templates/header.html"; ?>
    </div>
    <h1 class="display-1 text-style1">What Do We Sell?</h1>
    <main class="row mx-auto mt-lg-5 pt-lg-5 mb-lg-5 pb-lg-5">
    <?php $query="SELECT * FROM Product LIMIT 20";
    if($res=mysqli_query($con,$query))
    {
      $nor=mysqli_affected_rows($con);
      $query="SELECT * FROM Product LIMIT 20";
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

        <a href="Product.php?prodid=<?php echo $id; ?>" class="btn btn-lg btn-dark" target="_blank">Buy at &#x20B9;<?php echo $price; ?></a>
      </div>
    <?php }
    if($nor>20){
    ?>
    <div class="col-md-12 mt-lg-5">
        <a href="Shop.php" class="btn btn-lg btn-primary">Click Here for More</a>
    </div>
    <hr>
  <?php }}}?>

    </main>
<h1 class="display-4 text-style3">Why Royal Swag?</h1>
    <main class="row justify-content-center">
      <div class="col-md-12">
        <h2>Made Up of Ayurvedic component</h2>
      </div>
      <div class="col-md-3">
        <img src="Static/images/1.jpeg" alt="" width="100%">
        <h5>Tulsi</h5>
      </div>
      <div class="col-md-3">
        <img src="Static/images/methanol.jpeg" alt="" width="100%">
        <h5>Menthol</h5>
      </div>
      <div class="col-md-3">
        <img src="Static/images/cinnamon.jpeg" alt="" width="100%">
        <h5>Cinnamon</h5>
      </div>
      <div class="col-md-3">
        <img src="Static/images/clove.jpeg" alt="" width="100%">
        <h5>Clove</h5>
      </div>
      <div class="col-md-3">
        <img src="Static/images/greentea.jpeg" alt="" width="100%">
        <h5>Green Tea</h5>
      </div>
      <div class="col-md-3">
        <img src="Static/images/mulethi.jpeg" alt="" width="100%">
        <h5>Mulethi</h5>
      </div>
    </main>

    <div class="Footer mb-0" style="  overflow-x: hidden;">
      <?php require "Static/Templates/footer.html"; ?>
    </div>

  </body>
  <script src="Static/js/jquery.js" charset="utf-8"></script>
  <script src="Static/js/bootstrap.min.js" charset="utf-8"></script>
  <script src="Static/js/app.js" charset="utf-8"></script>
</html>
