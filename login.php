<?php 
session_start();
require 'connect.php';

if(isset($_SESSION['userid'])&& !empty($_SESSION['userid']))
{
 header("location:home.php");

}

else{
if (isset($_POST['email'])&& isset($_POST['password'])){

$errors = array();
$allowed_array=array('!','#','$','%','^','&','*',';','?','/','`',',');

$email = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['email']))))));
$email=str_replace($allowed_array," ",$email);


$password=  $_POST['password'];
mysqli_real_escape_string ($condb,$password);

			$hash_format= "$2y$11$";
			$salt="valarmorghulisvalardoharis";
			$format_and_salt= $hash_format. $salt;
			$password_hash = crypt($password, $format_and_salt );

   
   
   if (!empty($email)&& !empty($password)){
       $result=$condb-> query("SELECT * FROM `userlist` WHERE `email`= '$email'");
	       if (mysqli_num_rows($result) == true){
	   
             while ($row = mysqli_fetch_assoc($result)){
			    $name= $row['firstname'];
			    $set_password = $row['passwordhash'];
				$activated=$row['activated'];
				
				if($set_password != $password_hash){
				$errors[] = 'you must enter correct email & password';
		         }
				 
				
				else{
				
				   if($activated==0){
				 $_SESSION['email'] = $email;
				 header("location:activate.php");
		            }
				else{
				$result=$condb-> query("SELECT * FROM `userlist` WHERE `email`= '$email'");
				while ($row = mysqli_fetch_assoc($result)){
			 
			    $_SESSION['userid']  = $row['userid'];
				header("location:home.php");
				}
			
				}
				}	
				}
				
				}
        
		  else{
 $errors[]='No such account';}
	    
	}
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
<div class="box">
<div class="search">
<form class="form" align="center" action="login.php" method="POST">
<h1 class="text-center"> log in </h1>

<p>
<div class="input-group">
<span class="input-group-addon" id="ig"><span class="glyphicon glyphicon-user"></span></span>
<input type="email" class="form-control"  placeholder="Enter email " name="email" aria-describedby="ig" <?php  if (isset($_POST['email']) === true) { echo'value="', strip_tags($_POST['email']),'"';} ?> required autofocus>
</div>
</p>

<p>  
<div class="input-group">
<span class="input-group-addon" id="ig2"> <span class="glyphicon glyphicon-lock"></span></span>        
<input type="password" class="form-control" placeholder="Enter password" name="password" aria-describedby="ig2" required>
</div>
</p>

<button type="submit" class="btn btn-primary btn-block" value="submit" title="Log in for existing account">log in</button>

<div class="forgot">
&nbsp;
<p>   
<a href="forgot.php">forgot password</a>
</p>
</div>


<p>
<?php
if (empty($errors)=== false){
echo '<ul class="list-group">';
foreach($errors as $error){
echo ' <li class="list-group-item list-group-item-danger" >',$error,'</li>';
}
echo '</ul>';
}
?>
</p>
</form>
</div></div></div>

	 
	 
	 
	 
	 
<?php include("footer1.php");?>
	 