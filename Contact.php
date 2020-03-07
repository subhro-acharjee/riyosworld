
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
    <h1 class="display-1">Contact Us</h1>
    <hr>
    <hr>
    <main class="row">
      <div class="col-md-6 mx-auto " >
        <div class="row ">
          <div class="col-md-6 mx-auto">
            <h2 class="display-4">The StartUp Creator</h2>
            <br>
            <img src="" alt="">
            <h1> This Start up is planned, Funded and created by Supriyo Mondal </h1>
            <div class="row">
              <div class="col-md-4">
                <h1 class=""> <a href="https://www.facebook.com/varun.mondal.54" target="_blank"> <span class="badge badge-light"> <img src="Static/images/icon-social1.png" alt="" width=60px> </span> </a> </h1>
              </div>
              <div class="col-md-4">
                <h1 class=""> <a href=""> <span class="badge badge-light"> <img src="Static/images/icon-social2.png" alt="" width=60px> </span> </a> </h1>
              </div>

            </div>
            <div class="row mx-auto">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h2>Contacts</h2>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Contact no:-7003463217</li>
                      <li class="list-group-item">Email :-mondalsupriyo365@gmail.com</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-6 mx-auto">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <h3 class="display-4">The Website Creator</h3>
            <br>
            <img src="" alt="">
            <h1> This E-commerce site was created and desgined by <a class="nav-link" href="https://joseph444.github.io">Subhro Acharjee</a> </h1>
            <div class="row">
              <div class="col-md-4">
                <h1 class=""> <a href="https://www.facebook.com/subhro.acharjya" target="_blank"> <span class="badge badge-light"> <img src="Static/images/icon-social1.png" alt="" width=60px> </span> </a> </h1>
              </div>
              <div class="col-md-4">
                <h1 class=""> <a href="https://www.instagram.com/joseph_hellsking/" target="_blank"> <span class="badge badge-light"> <img src="Static/images/icon-social2.png" alt="" width=60px> </span> </a> </h1>
              </div>
              <div class="col-md-4">
                <h1 class=""> <a href="https://github.com/joseph444" target="_blank"> <span class="badge badge-light"> <img src="Static/images/icon-social3.png" alt="" width=60px> </span> </a> </h1>
              </div>
            </div>
            <div class="row mx-auto">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h2>Contacts</h2>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Contact no:- 8777063596</li>
                      <li class="list-group-item">WhatsApp no:- 8777063596</li>
                      <li class="list-group-item">Email :- subhrothecoder@gmail.com</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
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
