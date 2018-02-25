<?php 
ob_start();
 
?>





<html lang="en">

<head>
  <title>Log in</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/help.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>


 <body>
	 
	
	
<?php include("navbar1.php");?>

<div class="container">


<h3>
<div class="gray-box">

<p>
A new password has been sent to given email id .
</p>
<p>
please note that email may take few minutes to arrive.
</p>
<?php 
header("refresh:4;url=login.php");
?>
</h3>


</div> </div> 

	 
	 
	 
	 
	 
<?php include("footer1.php");?>
	 