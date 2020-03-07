<?php
session_start();

if(isset($_SESSION['sesid'] ))
{
  header("location: ../User/index.php");
  die(0);
}
else{
  require "../Config/config.php";
  if(isset($_POST['login'])){
  $email=$_POST['email'];
  $query="SELECT * FROM customer WHERE email=?";
  $stmt=mysqli_stmt_init($con);
  if(mysqli_stmt_prepare($stmt,$query)){
    $flag=false;
    mysqli_stmt_bind_param($stmt,'s',$email);
    if(mysqli_stmt_execute($stmt))
    {
      $res=mysqli_stmt_get_result($stmt);
      if(mysqli_num_rows($res)==0){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $phone=$_POST['phno'];
        $address=$_POST['addr'];
        $password=md5($_POST['password']);
        $status="Pending";
        $query="INSERT INTO `customer` ( `fname`, `lname`, `phoneno`, `address`, `email`, `status`, `password`) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
        if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,"sssssss",$fname,$lname,$phone,$address,$email,$status,$password);
            if(mysqli_stmt_execute($stmt)){
              $content=md5("verified");
              SendVerification_link($email,$content);
              header("location: login.php");
              die(0);
            }else {
              echo "<script>alert('Sign Up Failed')";
            }
        }
        else{
          echo "<script>alert(1)</script>";
        }

      }
      else{
        echo "<script>alert('account already exists')</script>";
      }
    }
    else{
  echo "<script>alert(2)</script>";
    }

  }
  else{

  }

  }
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../Static/css/bootstrap.min.css">
     <title>Sign up</title>
     <style media="screen">
       *{
         padding:0;
         margin:0;
       }
       h2{
         color:white;
         font-family:monospace;
       }
       #signupform{
         margin-top:20%;
       }
     </style>
   </head>
   <body class="bg-dark row text-center" style="background-image:url('https://res.cloudinary.com/subhro/image/upload/v1581139833/html-pages/bruno-kelzer-LvySG1hvuzI-unsplash_wwgxrw.jpg');background-size:cover;height:655px;background-position: center">
     <div class="col-md-5 mx-auto">
       <div class="card" id="signupform">
         <div class="card-header bg-secondary">
           <h2 class="">Sign up</h2>
         </div>
         <div class="card-body">
           <form method="post" id="login">
             <div class="form-row">
               <div class="col-md-12 form-group alert alert-danger inpas" style="display:none">
                 <h2>Password Didn't matched</h2>
               </div>
               <div class="col-md-12 form-group alert alert-danger incred" style="display:none">
                 <h2>Credential Exists</h2>
               </div>
               <div class="col-md-6 form-group">
                 <input type="text" class="form-control fname" placeholder="First name.." name="fname" >
               </div>

               <div class="col-md-6 form-group">
                 <input type="text" class="form-control lname" placeholder="Last Name.." name="lname" >
               </div>

               <div class="form-group col-md-12">
                 <input type="email" class="form-control email" placeholder="Email..." name="email">
               </div>
               <div class="form-group col-md-12">
                 <input type="text" class="form-control phone" name="phno" value="" placeholder="Phone.." >
               </div>
               <div class="form-group col-md-12">
                 <textarea class="form-control address" rows="5" cols="2" placeholder="Address"name="addr" ></textarea>
               </div>

               <div class="form-group col-md-12">
                 <input type="password" name="password"  class="form-control passwd" placeholder="Password...">
               </div>
               <div class="form-group col-md-12">
                 <input type="password" name="login" class="form-control repasswd" placeholder="Re-Password..." >
               </div>
             </div>
             <button type="button" name="login" class="btn btn-secondary btn-lg" onclick="checkCred()">Signup</button>
             <label for="">Already have an Account? <a href="login.php">Click here</a> </label>
           </form>
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
