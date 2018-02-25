<?php
session_start();
ob_start(); 
require 'connect.php';

$input="";
$firstname="";
$total="";
$allowed_array="";


if 
(isset($_POST['firstname'])&& 
isset($_POST['lastname']) && 
isset($_POST['email']) &&
isset($_POST['password'])&&
isset($_POST['passwordagain'])){

$errors = array();
$allowed_array=array('!','#','$','%','^','&','*',';','?','/','`',',');




$firstname = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['firstname']))))));
$firstname=str_replace($allowed_array," ",$firstname);

$lastname = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['lastname']))))));
$lastname=str_replace($allowed_array," ",$lastname);

$email = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['email']))))));
$email=str_replace($allowed_array," ",$email);



$password = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['password']))))));

$hash_format= "$2y$11$";
$salt="valarmorghulisvalardoharis";
$format_and_salt= $hash_format. $salt;
$password_hash = crypt($password, $format_and_salt );


$passwordagain = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['passwordagain']))))));

if (strlen($password) < 3){
$errors[] = 'Password too short! must be greater or equal to 6  letters';
}
if($password!=$passwordagain){
$errors[] = 'Password do not match';
}

     
if (empty($errors)){
			
$result=$condb->query( "SELECT `email` FROM `userlist` WHERE `email` ='$email'");

if (($result->num_rows) ==true){
$errors[] = 'Entered email already exists';
}

else {
$email_code= rand(0000, 9999);
				          
				
				$sql="INSERT INTO `userlist`(firstname, lastname, email, passwordhash,email_code) VALUES ('$firstname','$lastname','$email','$password_hash','$email_code')";
				$sql_run = mysqli_query($condb,$sql);
                
				$result=$condb-> query("SELECT * FROM `userlist` WHERE `email`= '$email'");
				while ($row = mysqli_fetch_assoc($result)){
			 
			    $_SESSION['email']  = $row['email'];
				}
			





				
$to=$email;
$subject="Account activation";
$message= "
<html>
<head>
<title>Account activation</title>
</head>
<body>
<p><br>dear  ".$firstname." \n your activation code is ".$email_code."</br></p>

<p><br>-Rooms are here</br></p>
</body>
</html>
";
$headers="MIME-version:1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .='From: <developers@roomsarehere.com>' . "\r\n";

          
mail($to,$subject,$message,$headers );
echo "Your account has been created. Please check your email and verify your email";

				 
 header("location:activate.php");
				 
			}


} 
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign up</title>
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
<div class="box">
<div class="search">
<form class="form-login" align="center" action="signup.php" method="post" >
<h1 class="text-center"> Sign up </h1>

<p>   <input type="text" class="form-control" name="firstname"  placeholder="first name"  <?php  if (isset($_POST['firstname']) === true) { echo'value="', strip_tags($_POST['firstname']),'"';} ?> required autofocus> <p>

<p>  <input type="text" class="form-control" name="lastname" placeholder="last name"  <?php  if (isset($_POST['lastname']) === true) { echo'value="', strip_tags($_POST['lastname']),'"';} ?>  required > <p>

<p>  <input type="email" class="form-control" name="email" placeholder=" email"  <?php  if (isset($_POST['email']) === true) { echo'value="', strip_tags($_POST['email']),'"';} ?>required > </p>

<p>  <input type="password" class="form-control" name="password" placeholder=" password"  required> </p>

<p>  <input type="password" class="form-control" name="passwordagain" placeholder="Confirm password" required> </p>

<p> <h5> By creating an account, you agree to out <a href="t&c.php"> terms & conditions </a> and our <a href="policy.php"> Policy </a> </h5> </p>

<p> <button type="submit" class="btn btn-primary btn-block" name="register" value="Register" >Sign up</button></p>

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
</div></div></div>
	
	
	
<?php include("footer1.php");?>