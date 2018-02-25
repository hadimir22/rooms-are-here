<?php
require 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Rooms are here</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/index.css" rel="stylesheet">
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>

<?php include("navbar1.php");?>



<div id="hero">
<div class="overlay">
<div class="container">

<div class="search">
<div id="yes"><h2></h2></div>
<form action="search.php" method="GET" align="center" >
<div class="input-group input-group-sm">
<input type="text" value="" placeholder="City State Zip etc" name="keywords" class="form-control" aria-describedby="thissize" required autofocus />
<span class="input-group-btn" id="thissize">
<button class="btn btn-default btn-block" ><span class="glyphicon glyphicon-search"></span>
</button>
</span> 
</div>
</form>
<p>or</p>
<a href="login.php" class="btn btn-block btn-sm btn-primary">Login to rent your room </a>
</div>
</div>
</div>
</div>


<div class="top">
<div class="container">
<div class="col-md-12 col-xs-12">
Top Towns
</div>
</div>
</div>


<div class="nexttop">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="portfolio-item ">
<a href="search.php?keywords=srinagar" class="preview" ">
<img src="images/sgr.png" class="img-responsive " alt="srinagar" />
</a>
</div>
</div>


<div class="col-lg-4  col-md-4 col-xs-12">
<div class="portfolio-item ">
<a href="search.php?keywords=Gandarbal" class="preview" >
<img src="images/gdb.png" class="img-responsive " alt="Gandarbal" />
</a>
</div>
</div>


<div class="col-lg-4 col-md-4 col-xs-12">
<div class="portfolio-item ">
<a href="search.php?keywords=budgam" class="preview">
<img src="images/bg.png" class="img-responsive " alt="budgam" />
</a>
</div>
</div>


<div class="col-lg-4 col-md-4 col-xs-12">
<div class="portfolio-item ">
<a href="search.php?keywords=anantnag" class="preview">
<img src="images/an.png" class="img-responsive " alt="annatnag" />
</a>
</div>
</div>

<div class="col-lg-4 col-md-4 col-xs-12">
<div class="portfolio-item ">
<a href="search.php?keywords=Awantipora" class="preview">
<img src="images/atp.png" class="img-responsive " alt="Awantipora" />
</a>
</div>
</div>

<div class="col-lg-4 col-md-4 col-xs-12">
<div class="portfolio-item ">
<a href="search.php?keywords=jammu" class="preview">
<img src="images/jmu.png" class="img-responsive " alt="jammu" />
</a>
</div>
</div>
</div>
</div>
</div>



<?php include("footer1.php"); ?>