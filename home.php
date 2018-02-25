<?php
session_start();
ob_start();
if(empty($_SESSION["userid"])){


header("location:login.php");

}

require 'connect.php';

$userid="";
$firstname="";



$userid= $_SESSION['userid'];




$result=$condb-> query("SELECT * FROM `userlist` WHERE `userid`= '$userid'");

while($row = mysqli_fetch_assoc($result)){
			   $firstname = $row['firstname'];
			   
}

?>

<!DOCTYPE html>


<html lang="en">

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/home.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>



<body>

<?php include("navbar2.php");?>




 
 <div id="hero">
<div class="overlay">
<div class="container">
<div class="search">
<form action="insearch.php" method="GET" align="center" >
<h3> <?php  echo "Hello ". $firstname;?> </h3>
<div class="input-group input-group-sm">
<input type="text" value="" placeholder="City State Zip etc" name="keywords" class="form-control" aria-describedby="thissize" required autofocus />
<span class="input-group-btn" id="thissize">
<button class="btn btn-danger btn-block" ><span class="glyphicon glyphicon-search"></span>
</button>
</span> 
</div>
</form>
<p>or</p>
<a href="swi.php" class="btn btn-block btn-sm btn-danger">Rent your room </a>
</div>
</div>
</div>
</div>
 
 <?php include("footer2.php");?>