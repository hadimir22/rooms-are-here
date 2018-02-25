<?php 
session_start();
ob_start();


if(empty($_SESSION["userid"])){
header("location:login.php");
}


require 'connect.php';

$firstname="";
$country ="";
$state ="";
$zip  ="";
$landmark ="";
$comadd  ="";
$looking ="";
$price  ="";
$currency  ="";
$payafter  ="";
$phoneno   ="";
$discription  ="";
$furnish   ="";
$userid="";


$userid= $_SESSION['userid'];

$errors = array();


if(isset($_POST['country'])&& 
   isset($_POST['state']) &&
   isset($_POST['zip'])&& 
   isset($_POST['landmark']) &&
   isset($_POST['comadd'])&& 
   isset($_POST['looking']) &&
   isset($_POST['price'])&& 
   isset($_POST['currency']) &&
   isset($_POST['payafter']) &&
   isset($_POST['phoneno'])&& 
   isset($_POST['furnish'])&&
   isset($_FILES['image']))
{
$errors = array();
$allowed_array=array('!','#','$','%','^','&','*','+',';','?','/','`');

$country     = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['country']))))));
$country=str_replace($allowed_array," ",$country);


$state		 = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['state']))))));
$state=str_replace($allowed_array," ",$state);


$zip 		 = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['zip']))))));
$zip=str_replace($allowed_array," ",$zip);


$landmark	 = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['landmark']))))));
$landmark=str_replace($allowed_array," ",$landmark);


$comadd		 = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['comadd']))))));
$comadd=str_replace($allowed_array," ",$comadd);

$looking     = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['looking']))))));


$price       = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['price']))))));
$price=str_replace($allowed_array," ",$price);

$currency    = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['currency']))))));


$payafter    = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['payafter']))))));


$phoneno     = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['phoneno']))))));
$phoneno=str_replace($allowed_array," ",$phoneno);

$discription = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['discription']))))));
$discription=str_replace($allowed_array," ",$discription);

$furnish     = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['furnish']))))));


if (strlen($zip) <= 3){
$errors[] = 'zip code too short!';
}  
if ( strlen($phoneno)<10 ){
$errors[] = 'contact number too short!';
}  
    
	
	  if (empty($errors)){
  		  
	  //imgae php begins////	  
   
   $allowed   = array('jpg','jpeg','png');
   $file_name = $_FILES['image']['name'];
   $file_extn = strtolower(end(explode('.', $file_name)));
   $file_temp = $_FILES['image']['tmp_name'];
   
       if (in_array($file_extn, $allowed)=== true ){
        	$file_path = 'uploads/'.substr(md5(time()), 0 , 10) . '.' . $file_extn;
			move_uploaded_file($file_temp, $file_path); 
			} 
		  
$query=mysqli_query($condb,"INSERT INTO rooms(country,state,zip,landmark,comadd,looking,price,currency,payafter,phoneno,discription,furnish,image,userid) VALUES('$country','$state','$zip','$landmark','$comadd','$looking','$price','$currency','$payafter','$phoneno','$discription','$furnish','$file_path','$userid')")  or die(mysqli_error($condb));
mysqli_close($condb); 
	if ($query){
	
	header("location:myroom.php");  
			
	}
else{

echo "<script type= 'text/javascript'>alert('sorry try again');</script>";
			       
}	

}

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Room</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/submit.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>


 <body>
	 
	 
<?php include("navbar2.php");?>

	 
	 
	 
	 
	 
<div class="container">

<div class="search">


<form class="form-login" align="center" action="swi.php" method="POST" enctype="multipart/form-data">
<h1 class="text-center"> Rent your Room </h1>
<hr>
<p> 
<label> location </label>

<div class="col-lg-4">
<input type="text" class="form-control"  placeholder="country" name="country" <?php  if (isset($_POST['country']) === true) { echo'value="', strip_tags($_POST['country']),'"';} ?>  required autofocus></input>
</div>
</p>

<p> 
<div class="col-lg-4">
<input type="text" class="form-control"  placeholder="state" name="state" <?php  if (isset($_POST['state']) === true) { echo'value="', strip_tags($_POST['state']),'"';} ?> required autocomplete></input>
</div>
</p>

<p>
<div class="col-lg-4">
<input type="number" class="form-control"  placeholder="zip code" name="zip" <?php  if (isset($_POST['zip']) === true) { echo'value="', strip_tags($_POST['zip']),'"';} ?> required autocomplete ="false"></input>
</div>
</p>
&nbsp;
<p>
<input type="text" class="form-control"  placeholder="nearst landmark"  name="landmark" <?php  if (isset($_POST['landmark']) === true) { echo'value="', strip_tags($_POST['landmark']),'"';} ?>  autocomplete ="false"></input>
</p>

&nbsp;
<p>
<textarea class="form-control"  placeholder="compelete address of your room"  name="comadd" required autocomplete ="false"></textarea>
</p>
&nbsp;


<p>
<label >looking for</label>
<select class="form-control" name="looking">
<option>customer</option>
<option>paying guest</option>
<option>Roommate</option>
<optgroup label="Roomate has to split the rent">
</optgroup>
</select
</p>


<p>
<input type="number" class="form-control"  placeholder="Price" name="price" <?php  if (isset($_POST['price']) === true) { echo'value="', strip_tags($_POST['price']),'"';} ?> required autocomplete ="false"></input>
</p>




<p>
<label >Currency</label>
<select class="form-control" name="currency" >
<option>Rupee</option>	
<option>Dollar</option>
<option>Euro</option>
<option>Pound</option>
<option>Dinar</option>
</select>
</p>

<p>
<label>payment after</label>
<select class="form-control" name="payafter">
<option>week</option>
<option>month</option>
<option>Quater</option>
<option>year</option>	 
</select>
</p>

<p>
<div class="phone">
<input type="number" class="form-control"  placeholder="your contact number" name="phoneno" <?php  if (isset($_POST['phoneno']) === true) { echo'value="', strip_tags($_POST['phoneno']),'"';} ?> required autocomplete ="false"></input>
</div>
</p>

<p>
<textarea class="form-control"  placeholder="Discription of your room" name="discription"  required autocomplete ="false"></textarea>
</p>




<p>
<select class="form-control"  name="furnish">
<option>Furnished</option>
<option>unfurnished</option>	 
</select>
</p>


<p>
<label>upload Picture.</label> 

<input type ="file" class="btn btn-default btn-file" name="image"  > </input>

</p>

<button type="submit" class="btn btn-danger btn-block" value="submit" title="send"> Rent it</button>

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
</div>
</div>



<?php include("footer2.php");?>