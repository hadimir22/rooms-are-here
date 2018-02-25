<?php
session_start();
ob_start();

if(empty($_SESSION["userid"])){
header("location:login.php");
}

?>



<!DOCTYPE html>


<html lang="en">

<head>
  <title>Settings</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/setting.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>


<body>
<?php include("navbar2.php");?>









<div class="gray-box">
<p>
<a href="changepass.php"  class="btn btn-danger btn-block btn-sm" title="change password" >Change Password</a> 
</P>

<hr>

<p>
<a href="changename.php"  class="btn btn-danger btn-block btn-sm" title="change name" >Change name</a> 
</P>




</div>

 
 
 
 
 

<?php include("footer2.php");?>