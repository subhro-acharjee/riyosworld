let slideIndex=0;
$(document).ready(function() {
  $("#aboutus").fadeIn();


  $(window).scroll(function(){
      if($(window).scrollTop()>500)
      {
        $("nav").css("background-color","grey","color","black");
      }
      else{
        $("nav").css("background-color","rgba(0,0,0,0.2)","color","white");
      }
  });


});

function search()
{
  let val=$("#search").val();
  if(val=='')
  {
    val='%';
  }
  $.post("Settings/search-product.php",{"search":val},function(data,status,xhr){
    if(status=="success")
    {
      $("#S-res").show();
      $("#S-res").html(data);

    }
      $("#S-rem").hide();
  });
}
function removeSearch()
{
  $("#search").val('');
  $("#S-res").hide();
  $("#S-rem").show();
  
}

function checkCred(){

  let fname=$(".fname").val();
  let lname=$(".lname").val();
  let email=$(".email").val();
  let phone=$(".Phone").val();
  let addres=$(".address").val();
  let pass=$(".passwd").val();
  let repass=$(".repasswd").val();
  if(fname==""||lname==""||email==""||phone==""||addres==""||pass==""||repass==""){
    alert("Empty Field");
    return;
  }
  else if(pass!=repass){
    $(".passwd").addClass("border border-danger")
    $(".inpas").show();
    return;
  }
  let myform= document.getElementById("login");
  var loginForm=new FormData(myform);
  myform.submit();

}
function shop(id){
  location.replace("Product.php?prodid="+id);
}
