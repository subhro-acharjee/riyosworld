
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
      <?php
      if(!isset($_SESSION['sesid']))
      require "Static/Templates/navbar.html";
      else
      require 'Static/Templates/account_navbar2.html';  ?>
    </div>
    <div class="HEAD">
      <?php require "Static/Templates/header.html"; ?>
    </div>
    <h1 class="display-1 text-dark">About Us</h1>
    <main class="row mb-lg-5 pb-lg-5" id="aboutus">
      <section class="col-md-3 mx-auto">
        <div class="card ">
          <div class="card-header">
            <h2 class="">Riyo's World</h2>
          </div>
          <div class="card-body bg-success">
          <p> Our Address :- Doctor Garden Nimta Kolkata 700049, <br>
          West Bengal India.<br>
          Our Email :- riyo@riyosworld.com  </p>
          </div>
        </div>
      </section>
      <section class="col-md-3 mx-auto">
        <div class="card " >
          <div class="card-header">
            <h2>Our Purpose</h2>
          </div>
          <div class="card-body bg-warning">
            <p> We are not here to be the man in the middle between producers and consumers,<br>
            But we are here to connect the <b>Distinct and Underrated Producers to the market.</b>
          We Beleive that our current market doesn't provide us with everything we want and that is why common people sometimes
        need to search alot for materials which are not commonly available. We would very much like to present this things at lowest of cost Possible. </p>
          </div>
        </div>
      </section>
      <section class="col-md-3 mx-auto">
        <div class="card ">
          <div class="card-header">
            <h2>Our Mission</h2>
          </div>
          <div class="card-body bg-primary">
            <p>We want to develop a integrated market where<br> online products, offline products and services will be available at lowest price possible.<br>
            This will not only help the consumers but<br> the underrated producers to get what they deserve. </p>
          </div>
        </div>
      </section>
      <section class="col-md-3 mx-auto">
        <div class="card ">
        </div>
        <div class="card-header">
          <h2>Our Expections</h2>
        </div>
        <div class="card-body bg-secondary">
          <p>As a StartUp we have two expectations.</p>
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h6>Consumer's Help</h6>
                </div>
                <div class="card-body">
                  <p>We would very much appriciate your comments and suggestions,<br>
                  So please help us to improve by letting us know.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h6>Consumers Support</h6>
                </div>
                <div class="card-body">
                  <p>If you like us Please help us to expand. Please share with your friends and family if have liked us.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
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
