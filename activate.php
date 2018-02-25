<?php 
session_start();
ob_start();
require 'connect.php';

$email=$_SESSION['email'];

if (empty($_SESSION['email'])){
header("location:login.php");
}

$nocongo="";
$email_code="";
$activated="";
$name="";

if 
(isset($_POST['email_code'])){

$errors = array();
$allowed_array=array('!','#','$','%','^','&','*','+',';','?','/','`',',');

	
$email_code = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['email_code']))))));
$email_code=str_replace($allowed_array," ",$email_code);


 
	 
	 $result=$condb-> query("SELECT * FROM `userlist` WHERE `email`= '$email'");
            if (!$result){
				 $errors[]="no such account";
				 }
  
                while ($row = mysqli_fetch_assoc($result)){
			    $name                = $row['firstname'];
				$activated           = $row['activated'];
				$set_code            = $row['email_code'];
				}
				
				if($activated==1){
				header("location:login.php");
				}
		           
                if($set_code === $email_code){
				  $result1 = "UPDATE `userlist` SET `activated` = 1  WHERE `email` ='$email'";
			      $result2= mysqli_query($condb,$result1);
				   if ($result2){
				     
			    $result=$condb-> query("SELECT * FROM `userlist` WHERE `email`= '$email'");
                
                while ($row = mysqli_fetch_assoc($result)){
			    
			   $_SESSION['userid']  = $row['userid'];
			   
				}
				   
				   
				   header("location:home.php");
				   
			       }
					
				    else{
				 
				    echo "<script type= 'text/javascript'>alert('something went wrong');</script>";
			          }
		            
			         }
					 
                  else{    
				  
                 	$errors[]="Wrong activation code";			  
				                  
				  }		
				  
			         
}

?>

<!DOCTYPE html>


<html lang="en">

<head>
  <title>Activation</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/signup.css" rel="stylesheet" />
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>

<body>

	 

<?php include("navbar1.php");?>

	 
	
<div class="container">
<div class="search">
     <form class="form-login" align="center"action="activate.php" method="post" >
	 <h1 class="text-center">Account Activation </h1>
     
     <hr>
	 
   
	 <p>  
	  <h5><label>Activation Code</label></h5>
     <input type="text" class="form-control" name="email_code" placeholder="Activation code" required autofocus> 	 
     </p>
	 
	 <p>
     <button type="submit" class="btn btn-danger btn-block"  >Activate</button>
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
	   
	   <hr>
	   <h5 class="text-center">An activation code was sent to given email id enter the same to activate your account  </h5>
	   <p><h5 class="text-center">please note that email may take few minutes to arrive  </h5></p>
     </form>
	 
	 </div> </div>
	
	 

	 


<?php include("footer2.php");?>
