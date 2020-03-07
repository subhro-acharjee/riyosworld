<?php
session_start();

if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
else{
  require "../Config/config.php";
  if(isset($_POST['login']))
  {
  $query="SELECT * FROM customer WHERE email = ? AND password = ?";
  $stmt=mysqli_stmt_init($con);
  if(mysqli_stmt_prepare($stmt,$query)){
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    mysqli_stmt_bind_param($stmt,"ss",$email,$password);
    if(mysqli_stmt_execute($stmt)){
      $res=mysqli_stmt_get_result($stmt);
      if(mysqli_num_rows($res)>0){
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"ss",$email,$password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$id,$fname,$lname,$phno,$address,$email,$status,$password);
        mysqli_stmt_fetch($stmt);
        $_SESSION['sesid']=md5($id."|".$fname);
        $_SESSION['name']=$fname;
        $_SESSION['id']=$id;
        if(!isset($_SESSION['redirect']))
      { header("location: ../User/index.php");
        die(0);}
        else{
          header("location: ".$_SESSION['redirect']);
            die(0);
        }
      }
      else{
        echo "<script>alert('InValid Login')</script>";
      }
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
     <style media="screen">
       *{
         margin:0;
         padding:0;
         overflow:hidden;
       }
       .text-sans{
         font-family:monospace;
       }
       #login-form{
         margin-top:40%
       }
     </style>
   </head>
   <body class="bg-dark" style="background-image:url('https://res.cloudinary.com/subhro/image/upload/v1581139833/html-pages/bruno-kelzer-LvySG1hvuzI-unsplash_wwgxrw.jpg');background-size:cover;height:655px;background-position: center">
     <div class="row">
       <div class="col-md-3 mx-auto">
         <div class="card" id="login-form">
           <div class="card-header text-center bg-secondary">
             <h1 class="display1 text-style3 text-light">Login</h1>
           </div>
           <div class="card-body">
             <div class="col-md-12 alert alert-danger" id="invalid" style="display:none">
               <h2>Invalid Login</h2>
             </div>
             <form class="form-group text-center" method="post">

               <input type="email" class="form-control" name="email" placeholder="Email...">
               <input type="password" class="form-control mt-2" name="password" placeholder="password...">
               <label for="forgetpassword" class="text text-sans mb-0">Forgot the password? <a href="forget.php" class="link">click here</a> </label>
               <br>
               <input type="hidden" name="login" value="login">
               <button type="submit" class="btn btn-secondary">Login</button>
               <br>
               <label class="text"> New Here? <a href="signup.php">Signup</a> </label>
             </form>
           </div>
         </div>
       </div>
     </div>
   </body>
   <script src="../Static/js/jquery.js"></script>
    <script src="../Static/js/bootstrap.min.js"></script>
   <script src="../Static/js/app.js" charset="utf-8"></script>
 </html>
<?php }



?>
