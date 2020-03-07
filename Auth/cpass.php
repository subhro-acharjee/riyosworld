<?php session_start();
if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
else{
  if(!isset($_GET['otp'])){
    header("location: ../index.php");
    die(0);
  }
  else{
    require "../Config/config.php";

    $arr=explode("|",base64_decode($_GET['otp']));
    $otp=$arr[0];
    $email=$arr[1];
    $stmt=mysqli_stmt_init($con);
    if(mysqli_stmt_prepare($stmt,"SELECT * FROM otp WHERE otp=?")){
      mysqli_stmt_bind_param($stmt,"i",$otp);
      $stmt->execute();
      $res=$stmt->get_result();

      $row=$res->fetch_assoc();

      $status=$row['status'];
      if(mysqli_affected_rows($con)==0||$status==1){

        header("location: ../index.php");
        die(0);
      }
      else{
        $status=1;
        if(mysqli_stmt_prepare($stmt,"UPDATE otp SET status=? WHERE otp=?")){
          mysqli_stmt_bind_param($stmt,"ii",$status,$otp);
          if(mysqli_stmt_execute($stmt)){
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
          <body class="row text-center" style="background-image:url('https://res.cloudinary.com/subhro/image/upload/v1581139833/html-pages/bruno-kelzer-LvySG1hvuzI-unsplash_wwgxrw.jpg');background-size:cover;height:655px;background-position: center">
            <div class="col-md-5 mt-lg-5 pt-lg-5 mx-auto text-center" style="margin-top:10%">
              <div class=" text-center">
                <div class= "mt-lg-5 pt-lg-5 text-center card-header bg-light">
                  <h2 class="display-4">Change Password</h2>
                  <form class="form-group" action="mpass.php" method="post" id="change">
                    <input type="password" name="password" class="form-control " value="" placeholder="Password..." id="pass">
                    <input type="password" name="repass" value="" class="form-control" placeholder="Re-type Password..." id="repass">
                    <input type="hidden" name="forget" value="<?php echo $email; ?>">
                    <button type="button" name="button" id="forget" class="btn btn-primary btn-lg" >Change</button>
                  </form>

                </div>

              </div>
            </div>
          </body>
          <script src="../Static/js/jquery.js"></script>
           <script src="../Static/js/bootstrap.min.js"></script>
          <script src="../Static/js/app.js" charset="utf-8"></script>
          <script>
          $(document).ready(function() {
            $("#forget").click(function(){
              if($("#pass").val()!=$("#repass").val()){
                alert("Password Didn't matched");
              }
              else if($("#pass").val()==""||$("#repass").val()==""){
                alert("Empty Field")
              }
              else{
                let frm=document.getElementById("change");
                frm.submit();
              }
            });
          });

          </script>
        </html>

  <?     }
}
else{
  echo 4;
}
}}?>
