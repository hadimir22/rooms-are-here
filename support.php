<?php
if(isset($_POST['submit']))
{
$name = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['name']))))));
$name=str_replace($allowed_array," ",$name);


$email = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['email']))))));
$email=str_replace($allowed_array," ",$email);


$subject = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['subject']))))));
$subject=str_replace($allowed_array," ",$subject);


$message = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_POST['message']))))));

$to ="wahdatbutt@gmail.com";
$headers= "From: $name<$email>";
$message= "Name: $name \n\n email: $email \n\n Subject: $subject \n\n Message: $message";
if(mail($to,$subject,$message,$headers))
{
echo "<script type= 'text/javascript'>alert('Email sent. We will contact you soon');</script>";
header("refresh:2;url=support.php");
}
else
{
echo" Error: Please try again";
}

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Support</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/support.css" rel="stylesheet">
   <link rel="shortcut icon" href="images/favicon.ico" />
  
</head>
<body>

<?php include("navbar1.php");?>

<div class="container">
<div class="row">
<div class="col-md-12 col-xs-12 ">
<div class="search">


<?php  
if (isset($_GET['sent'])=== true){
echo 'Thanks for contacting us';
}
else{
?>


<form class="form-login" align="center" action="support.php" method="POST" >
<h2 class="text-center"> Feel free to say  </h2>
<p> <input    class="form-control" type="text"  name="name"    placeholder=" your full name" <?php  if (isset($_POST['name']) === true) { echo'value="', strip_tags($_POST['name']),'"';} ?> required autofocus></input></p>
<p> <input    class="form-control" type="email" name="email"   placeholder="your email"      <?php  if (isset($_POST['email']) === true) { echo'value="', strip_tags($_POST['email']),'"';} ?> required ></input> </p>
<p> <input    class="form-control" type="text"  name="subject" placeholder="Subject"         <?php  if (isset($_POST['subject']) === true) { echo strip_tags($_POST['subject']);} ?> required ></input></p>	 
<p> <textarea class="form-control" type="text"  name="message" placeholder="your message"    <?php  if (isset($_POST['message']) === true) { echo strip_tags($_POST['message']);} ?> required ></textarea></p>
<button type="submit" name="submit" class="btn btn-primary btn-block" value="send message" title="submit"> send message</button>

<p>
<?php
if (empty($errors)=== false){
echo '<ul>';
foreach($errors as $error){
echo '<li class="list-group-item list-group-item-danger" >',$error,'</li>';
}
echo '</ul>';
}
?>
</p>
</form>


<?php
}
?>
</div>
</div>
</div> 
</div>


 
 
  
<?php include("footer1.php");?>