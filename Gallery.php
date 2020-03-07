
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
        require 'Static/Templates/account_navbar2.html';    ?>
    </div>
    <div class="HEAD">
      <?php require "Static/Templates/header.html"; ?>
    </div>

    <h1 class="display-1 text-dark">Gallery</h1>
    <hr>
    <main class="row mt-lg-5 mp-ld-5 mb-lg-5 pb-lg-5 mx-auto">

      <div class="col-md-6 bg-secondary border-2 border-secondary  mx-auto">
        <?php
        $query="SELECT * FROM Gallery";
        if($res=mysqli_query($con,$query))
        {
          if(mysqli_affected_rows($con)==0)
          {
            include "Static/Templates/not-found.html";
          }
          else{
            while(($data=mysqli_fetch_array($res))){
              $name=$data['name'];
              $description=$data['description'];
              $link=explode("|",$data['link']);
              $id=$data['slno'];
        ?>
        <div class="jumbotron-fluid jumbotron card d-block text-center mt-lg-5 mp-ld-5 mb-lg-5 pb-lg-5 bg-light" >
          <h1 class="display-4"><?php echo $name ?></h1>
          <h5><?php echo $description ?></h5>
          <div class="" id="<?php echo $id ?>">
            <?php foreach ($link as $image) {
              // code...
              ?>
              <div class="">
                <img src="<?php echo $image?>" alt="" width=100% class="card-imge-top">
              </div>
              <?php
            }
            ?>
          </div>

        </div>
        <?php
        }}} ?>
      </div>
    </main>
    <div class="Footer mb-0" style="  overflow-x: hidden">
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
