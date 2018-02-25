<?php 
session_start();
ob_start();
require 'connect.php';

$generated="";
$password_hash ="";
$errors = array();
 
if (isset($_POST['email'])){

$allowed_array=array('!','#','$','%','^','&','*',';','?','/','`',',');

$email = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['email']))))));
$email=str_replace($allowed_array," ",$email);



            $generated=  substr(rand(999, 999999),0,8);
			$hash_format= "$2y$11$";
			$salt="valarmorghulisvalardoharis";
			$format_and_salt= $hash_format. $salt;
			$password_hash = crypt($generated, $format_and_salt );
   
 


			 
 

   if (empty($errors)){
       $result=$condb-> query("SELECT * FROM `userlist` WHERE `email`= '$email'");
	             
		 $result = $condb-> query("UPDATE `userlist` SET `passwordhash` = '$password_hash'  WHERE `email` ='$email' ");
				   
 $to=$email;
			   
                      $subject="Rooms Are Here new password request";
$message= "
<html>
<head>
<title>Rooms Are Here new password request</title>
</head>
<body>
<style>
div {
    background-color: lightgrey;
    width: 300px;
    border: 25px solid blue;
    padding: 25px;
    margin: 25px;
}
</style>
<div>
<p>Dear your new password is $generated</p>
<h1>$firstname</h1>

</div>
</body>
</html>
";
$headers="MIME-version:1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .='From: <developers@roomsarehere.com>' . "\r\n";

          
mail($to,$subject,$message,$headers );


header("location:pr.php");

			

		
				}
       
	}
 
?>





<html lang="en">

<head>
  <title>Log in</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/login.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>


 <body>
	 
	
<?php include("navbar1.php");?>

<div class="container">
<div class="search">
<div class="col-md-12 col-sm-12">
<form class="form-login"  align="center" action="forgot.php" method="POST">
<h1 class="text-center"> Password recovery </h1>
<hr>
<p>
<label>A new automatically generated password will be sent to your registered email </label>
<label> </label>
<input type="email" class="form-control"  placeholder="Enter email" name="email" <?php  if (isset($_POST['email']) === true) { echo'value="', strip_tags($_POST['email']),'"';} ?> required autofocus>



<p>
<button type="submit" class="btn btn-danger btn-block" value="submit" title="Send New Password">Send new password</button>
</p>

<?php
if (empty($errors)=== false){
echo '<ul class="list-group">';
foreach($errors as $error){
echo '<li class="list-group-item list-group-item-danger" >',$error,'</li>';
}
echo '</ul>';
}
?>


</form>
</div>
</div>
</div>

<?php include("footer1.php");?>
	 