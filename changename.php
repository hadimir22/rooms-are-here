<?php 
session_start();
ob_start();

if(empty($_SESSION["userid"])){
header("location:login.php");
}

require 'connect.php';
$userid="";
$userid= $_SESSION['userid'];

$result=$condb-> query("SELECT * FROM `userlist` WHERE `userid`= '$userid'");

while($row = mysqli_fetch_assoc($result)){
			   $fname = $row['firstname'];
			   $lname = $row['lastname'];
}
if 
(isset($_POST['firstname'])){

$errors = array();
$allowed_array=array('!','#','$','%','^','&','*','+',';','?','/','`',',');


$firstname = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['firstname']))))));
$firstname=str_replace($allowed_array," ",$firstname);


$lastname = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['lastname']))))));
$lastname=str_replace($allowed_array," ",$lastname);


if (strlen($firstname) <= 2){
$errors[] = 'name too short';
}
    
	  if (empty($errors)){
$sql="UPDATE `userlist` SET `firstname` = '$firstname', `lastname`= '$lastname' WHERE `userid` ='$userid' ";
$sql_run = mysqli_query($condb,$sql);

if ($sql_run){ 

echo "<script type= 'text/javascript'>alert('name changed');</script>";
header("refresh:1;url=home.php");
}
else{

echo "<script type= 'text/javascript'>alert('something went wrong');</script>";
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

<form class="form-login" action="changename.php" method="post" align="center" >
<h2 class="text-center"> Change name </h2>

<hr>


<p> 
<div class="input-group">
<span class="input-group-addon" id="ig"><strong>First Name</strong></span>
<input type="text" class="form-control" name="firstname" placeholder="first name" <?php    echo'value="',$fname,'"'; ?> required>
</div>
</p>

<p>  
<div class="input-group">
<span class="input-group-addon" id="ig"><strong>Last Name</strong></span>
<input type="text" class="form-control" name="lastname" placeholder="last name" <?php    echo'value="',$lname ,'"'; ?> required> 	 
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