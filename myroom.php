<?php
session_start();
ob_start();

if(empty($_SESSION["userid"])){
header("location:login.php");
}


require 'connect.php';
$userid="";
$firstname="";
$count1= "";
$img_path= "";
$country="";
$state="";
$zip="";
$landmark="";
$comadd="";
$looking="";
$price="";
$currency="";
$payafter="";
$phoneno="";
$discription="";
$furnish="";
$hide="";
$page="";
$nextpage="";
$prevpage="";
$returned="";

$userid= $_SESSION['userid'];


//////////for name//////////////////////////////////////////////////
$result1=$condb-> query("SELECT * FROM `userlist` WHERE `userid`= '$userid' ");
        while($row = mysqli_fetch_assoc($result1)){
			   $firstname = $row['firstname'];
			    }
				
//////////////////////////////////////////////////////////////////
				


//////////for display//////////////////////////////////////////////	  
$result=$condb-> query("SELECT * FROM `rooms` WHERE `userid`= '$userid'  ");
      if (($result->num_rows) == false){
                          $errors = "Dear ".$firstname." you have not rented any of your room(s)";
	
		                   }
		else{
		
		  
		   while($row = mysqli_fetch_assoc($result)){
		    $returned_results[]= array(
			   'id1'          => $row['id'],
			   'country'     => $row['country'],
			   'state'       => $row['state'],
			   'zip'         => $row['zip'],
			   'landmark'    => $row['landmark'],
			   'comadd'      => $row['comadd'],
			   'looking'     => $row['looking'],
			   'price'       => $row['price'],
			   'currency'    => $row['currency'],
			   'payafter'    => $row['payafter'],
			   'phoneno'     => $row['phoneno'],
			   'discription' => $row['discription'],
			   'furnish'     => $row['furnish'],
			   'img_path'    => $row['image']
			   
			   );
			    
					
              }
			  $count1=count($returned_results);
	     
	
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>My rooms</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/myroom.css" rel="stylesheet" />
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>



<body>
<?php include("navbar2.php");?>


<div class="gray-box">
<div class="panel panel-success">
<div class="panel-heading">
rent your rooms with rooms are here &nbsp; &nbsp; 
<a href="swi.php" button type="submit" class="btn btn-warning btn-sm" >Rent your Room</a>
&nbsp;

</div>
</div>
</div>



<?php if(!empty($errors)) { ?>
<div class="panel panel-danger">
<div class="panel-heading">
<?php echo $errors; ?>
</div>
</div>
<?php }?>






<div class="container">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">	
<?php
  		 for ($i=0; $i < $count1; $i++){
		       $id          = $returned_results[$i]['id1'];
		       $country     = $returned_results[$i]['country'];
			   $state       = $returned_results[$i]['state'];
			   $zip         = $returned_results[$i]['zip'];
			   $landmark    = $returned_results[$i]['landmark'];
			   $comadd      = $returned_results[$i]['comadd'];
			   $looking     = $returned_results[$i]['looking'];
			   $price       = $returned_results[$i]['price'];
			   $currency    = $returned_results[$i]['currency'];
			   $payafter    = $returned_results[$i]['payafter'];
			   $phoneno     = $returned_results[$i]['phoneno'];
			   $discription = $returned_results[$i]['discription'];
			   $furnish     = $returned_results[$i]['furnish'];
			   $img_path    = $returned_results[$i]['img_path'];
			   

?>



<p>

<div class="col-lg-4 col-md-6 col-sm-12 ">
<div class="result">
<div class="panel panel-default">	
<div class="panel-heading" role="tab" id="h<?php echo $i;?>">
<h4 class="panel-title"> 
<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#c<?php echo $i;?>" 
aria-expanded="false" aria-controls="c<?php echo $i;?>">
	 <p class="text-info"><span class="glyphicon glyphicon-map-marker"></span>
	 <strong><?php echo $comadd."  ".$state." ".$country." ".$zip;?></strong></p>
	 
	<p> <img src="<?php if(empty($img_path)){echo"images/t.jpg";}else{ echo $img_path;}?>" class="img-responsive" > </p>
	

	<hr>

<div class="text-success"><?php echo $price ." ".$currency ." "."per"." ".$payafter;?> <span class="caret"></span> 
<!------//-----\\------ for delete------//-----\\---->	
<div class="pull-right">
<a href="myroom.php?delid=<?php echo $id;?>">
<button type="submit" name="delete" class="btn btn-default btn-sm"  title="delete"> <span class="glyphicon glyphicon-trash"></span> </button>
</a>
</div>
<!------//-----\\------ for delete------//-----\\---->	
</div>

</a></h4>
	<hr>

</div>


<div id="c<?php echo $i;?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="h<?php echo $i;?>">
<div class="panel-body">
<p><span class="glyphicon glyphicon-phone"></span>&nbsp;
<?php echo $phoneno;?>
</p>
<p><span class="glyphicon glyphicon-tower"></span>&nbsp;
<?php if (empty($landmark)){echo "nearest landmark unavailable"; } else{ echo $landmark;}?>
</p>

<p><span class="glyphicon glyphicon-home"></span>&nbsp;
The room is <?php echo $furnish;?>
</p>

<p><span class="glyphicon glyphicon-user"></span>&nbsp;
I am looking for a <?php echo $looking;?>  </p>

<p><span class="glyphicon glyphicon-info-sign"></span>&nbsp;
<?php if(empty($discription)){echo"Room discription unavailable";}else{ echo  $discription;}?>
</p>


</div>
</div>

</div>
</div>

</p>

</div>

	
<?php } ?>
</div>
</div>


<?php
if (isset($_GET['delid'])){

$delid=mysqli_real_escape_string($condb,$_GET['delid']);
$query=mysqli_query($condb,"DELETE FROM `rooms` WHERE `id` = '$delid' AND `userid`='$userid' ");
if ($query){
header("location:myroom.php");  
}
else{
echo "<script type= 'text/javascript'>alert('please try again');</script>";
}}?>
<!------//-----\\------ for delete ends------//-----\\---->	








<?php include("footer2.php");?>
 