
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

    <div class="row">
      <div class="col-md-6 mx-auto text-center">
        <div class="form-group mt-lg-5 mb-lg-5">
          <input type="search" id="search" value="" autocomplete="on" class="form-control" placeholder="Search...">
          <div class="btn-group">
            <button type="button" class="btn btn-lg btn-primary" onclick="search()">Search</button>
            <button type="button" name="button" class="btn btn-lg btn-secondary" onclick="removeSearch()">x</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 mx-auto text-center" id="S-rem">
        <div class="row">
          <div class="col-md-8 mx-auto" style="overflow:hidden">
            <div class="card-group">
        <?php
          $Qwery="SELECT * FROM Product";

        if($res=mysqli_query($con,$Qwery)){
        while($row=mysqli_fetch_array($res))
        {
          $id=$row['id'];
          $name=$row['name'];
          $cost= $row['mrp'];
          $desc=$row['description'];
          $link=$row['image link'];

      ?>
      <div class="card" onclick="shop('<?php echo $id;?>');">
        <img src="<?php echo $link; ?>" alt="" class="card-image-top" width=100% >
        <div class="card-header bg-primary">
          <h2 class="card-title"><?php echo $name; ?></h2>
        </div>
        <div class="card-body">
          <h4>Price: <?php echo $cost;?></h4>

          <h6>Description:<?php echo $desc; ?></h6>
        </div>
      </div>
    <?php
        }
      }
        else{
          echo "<h1 class='display-1'>NO DATA!</h1>";
        }
         ?>
       </div>
     </div>
   </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 mx-auto text-center" >
        <div class="row">
          <div class="col-md-8 mx-auto" style="overflow:hidden">
            <div class="card-group" id="S-res">
            </div>
          </div>
        </div>
      </div>
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
