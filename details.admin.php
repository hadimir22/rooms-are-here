<?php 
session_start();
require 'connect.php';
$result1=$condb-> query("SELECT * FROM `userlist`");
$users=mysqli_num_rows($result1);

$result2=$condb-> query("SELECT * FROM `rooms`");
$rooms=mysqli_num_rows($result2)



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Administrator</title>

 
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/admin.css" rel="stylesheet" />
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
 <?php include("navbar1.php");?>
 

 
<div class="container">
<div class="row">


<div class="col-md-6 col-sm-6 ">
<h3>Total number of Rooms</h3>
<hr>
<h1>
<?php echo $rooms; ?>
</h1>
</div>



<div class="col-md-6 col-sm-6">
<h3>Total number of users</h3>
<hr>
<h1>
<?php echo $users;?>
</h1>
</div>



</div>
</div>






 
 <?php include("footer1.php");?>