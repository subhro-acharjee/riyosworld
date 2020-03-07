<?php
session_start();

if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
else{
  
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
  <body class="row text-center" style="background-image:url('https://res.cloudinary.com/subhro/image/upload/v1581139833/html-pages/bruno-kelzer-LvySG1hvuzI-unsplash_wwgxrw.jpg');background-size:cover;height:655px;background-position: center">
    <div class="col-md-5 mx-auto text-center">
      <div class="mt-lg-5 text-center">
        <div class="mt-lg-5 text-center card-header bg-light">
          <h2 class="display-1 text-center">Find Your Email</h2>
          <input type="email" name="email" class="form-control " value="" id="email">
          <button type="button" name="button" id="search_email" class="btn btn-primary btn-lg">Search</button>
          <div class="alert alert-primary" id="res">

          </div>
        </div>

      </div>
    </div>
  </body>
  <script src="../Static/js/jquery.js"></script>
   <script src="../Static/js/bootstrap.min.js"></script>
  <script src="../Static/js/app.js" charset="utf-8"></script>
  <script>
  $(document).ready(function() {
    $("#search_email").click(function(){
      $.ajax({
        url:"index.php",
        type:"POST",
        data:{
          "email":$("#email").val()
        },
        success:function(res){
          $("#res").html(res);
        }

      })
    })
  });

  </script>
</html>
<?php }
?>
