<?php  
$connect_error='server not found';
$condb = mysqli_connect('localhost','hadimir','hadimir33##');
mysqli_select_db($condb,'userss');

if (!mysqli_connect('localhost','hadimir','hadimir33##') || !mysqli_select_db($condb,'userss') ){
  die ($connect_error);}

  
  else{
  }
?>