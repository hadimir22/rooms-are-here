<?php 
session_start();
ob_start();

if(empty($_SESSION["userid"])){
header("location:login.php");
}

require 'connect.php';
$userid="";
$pword="";
$password_hash1="";
$userid= $_SESSION['userid'];

if 
(isset($_POST['password'])&& 
isset($_POST['newpassword']) && 
isset($_POST['passwordagain'])){

$password  =    $_POST['password'];
mysqli_real_escape_string($condb,$password);
$hash_format= "$2y$11$";
$salt="valarmorghulisvalardoharis";
$format_and_salt= $hash_format. $salt;
$password_hash1 = crypt($password, $format_and_salt );

$newpassword=    $_POST['newpassword'];
mysqli_real_escape_string($condb,$newpassword);
$hash_format= "$2y$11$";
$salt="valarmorghulisvalardoharis";
$format_and_salt= $hash_format. $salt;
$password_hash = crypt($newpassword, $format_and_salt );


$passwordagain = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['passwordagain']))))));


     $errors = array();
	  if (!empty($password) && !empty($newpassword) && !empty($passwordagain)){
					
									
				$result=$condb-> query("SELECT * FROM `userlist` WHERE `userid`= '$userid'");

				while($row = mysqli_fetch_assoc($result)){
							   $pword = $row['passwordhash'];
							   }
				

					
					 if($password_hash1 != $pword){
					 $errors[] = 'wrong current Password';
					  }
						
						if (strlen($newpassword) < 6){
					    $errors[] = 'new Password too short! must be greater or equal to 6  letters';
					     }
						 
						  if($newpassword!=$passwordagain){
					       $errors[] = 'confirm password do not match';
					        }
							
					  
		 
		              if (empty($errors)=== true) {
			          $result1 = $condb-> query("UPDATE `userlist` SET `passwordhash` = '$password_hash'  WHERE `userid` ='$userid' ");
				   
			
				 if ( $result1){
				     
					 echo "<script type= 'text/javascript'>alert('password changed');</script>";
			        header("refresh:1;url=home.php");
					}
					
				  else{
				 
				    echo "<script type= 'text/javascript'>alert('something went wrong');</script>";
			          }
			                 }
			                 
			}
			
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
  <link  href="css/passname.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>



<body>
<?php include("navbar2.php");?>
	 
	 
	
<div class="container">
<div class="change">
<form class="form-login" action="changepass.php" align="center" method="post" >
<h2 class="text-center">change password</h2>
<hr>

<p>
<div class="input-group">
<span class="input-group-addon" id="ig"><strong>Current password</strong></span>
<input type="password" class="form-control" name="password"   required>
</div>
</p>

<p> 
<div class="input-group">
<span class="input-group-addon" id="ig"><strong>New password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>	 
<input type="password" class="form-control" name="newpassword" required>
</div>
</p>

<p>
<div class="input-group">
<span class="input-group-addon" id="ig"><strong>confirm password</strong></span>	  
<input type="password" class="form-control" name="passwordagain"  required>
</div>
</p>



<p>
<button type="submit" class="btn btn-danger btn-block" name="register" value="Register" >update</button>
</p>

<p>

<?php
if (empty($errors)=== false){
echo '<ul class="list-group">';
foreach($errors as $error){
echo '<li class="list-group-item list-group-item-danger" >',$error,'</li>';
}
echo '</ul>';
}

?>


</p>

</form>

</div></div>
	
	 

<?php include("footer2.php");?>
