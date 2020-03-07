<?php

require '../Config/config.php';

if(isset($_POST['search'])){
  $var=htmlentities($_POST['search']);
  $qwery="SELECT * FROM Product WHERE name LIKE '%$var%'";

if($res=mysqli_query($con,$qwery)){
  if(mysqli_affected_rows($con)>0){
    while($row=mysqli_fetch_assoc($res)){
    $id=$row['id'];
    $name=$row['name'];

    $cost= $row['mrp'];
    $desc=$row['description'];
    $link=$row['image link'];
    include "../Static/Templates/search-result.php";
  }
}

  else{
    include "../Static/Templates/not-found.html";
  }
}
else{
  echo "<h1 class='display-1'>NO DATA!</h1>";
}
}


 ?>
