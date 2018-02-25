<?php
require 'connect.php';

$keywords="";
$results_num="";
$count1="";
$id="";
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

$errors= array();
$allowed_array=array('!','#','$','%','^','&','*','+',';','?','/','`',',');

if(isset($_GET['keywords'])){
$keywords = mysqli_real_escape_string($condb, htmlspecialchars(htmlentities(stripslashes((trim($_GET['keywords']))))));
$keywords=str_replace($allowed_array," ",$keywords);


if(empty($keywords)){
$errors[]= 'enter keyword to search data  ';
}


else if (strlen($keywords)<3){
$errors[]= 'keywords too short';
}

   if (empty($errors)){
   
     $returned_results= array();
	 $where = "";
     $keywords = preg_split('/[\s]+/', $keywords);
     $total_keywords= count($keywords);
   
   foreach($keywords as $key => $keyword){
    $where .= "`country` LIKE '%$keyword%' OR `state` LIKE '%$keyword%' OR`zip` LIKE '%$keyword%' OR`landmark` LIKE '%$keyword%' OR`comadd` LIKE '%$keyword%'";
      
	  if ($key != ($total_keywords - 1)){
	    $where .= " AND ";
	  
	  }
   }  
   

	  
   $query=mysqli_query($condb,"SELECT * FROM `rooms` WHERE $where ")  or die(mysqli_error($condb));
   mysqli_close($condb); 
   $count1=mysqli_num_rows($query);
   
   
	if(!$query){
	   

	  } 
	  else{ 
	  
	  
		   while($row = mysqli_fetch_assoc($query)){
		    $returned_results[]= array(
			   'id'          => $row['id'],
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
			   );}
			   
			  $count1=count($returned_results);
	     
   }


   }
 }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Rooms are here</title>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="css/bootstrap.min.css" rel="stylesheet">
  <link  href="css/search.css" rel="stylesheet">
   <link rel="shortcut icon" href="images/favicon.ico" />
</head>


<body>

<?php include("navbar1.php");?>

<div class="container">
<div class="search">
<form action="search.php" method="GET" align="center" >
<div class="input-group input-group-sm">
<input type="text" value="" placeholder="City State Zip etc" name="keywords" class="form-control" aria-describedby="thissize" required autofocus />
<span class="input-group-btn" id="thissize">
<button class="btn btn-primary btn-block" ><span class="glyphicon glyphicon-search"></span>
</button>
</span> 
</div>
</form>
</div>
</div>







<?php
if($count1===0){ ?>
<div class="container">
<div class="resultz">
<ul class="list-group">
<li class="list-group-item list-group-item-danger" > Sorry we have nothing for you! try some different keyword</li>
</ul>
</div>
</div>
<?php }?>


<?php
if (empty($errors)=== false){?>
<div class="container">
<div class="resultz">
<ul class="list-group">
<li class="list-group-item list-group-item-danger" > <?php foreach($errors as $error){echo $error;}?></li>
</ul>
</div>
</div>
<?php }?>






<div class="container">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">	

<?php
  		 for ($i=0; $i < $count1; $i++){
		       $id          = $returned_results[$i]['id'];
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
	<div class="text-success"><?php echo $price ." ".$currency ." "."per"." ".$payafter;?> <span class="caret"></span> </div>
	</a></h4><hr>
</div>


<div id="c<?php echo $i;?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="h<?php echo $i;?>">
<div class="panel-body">
<p><span class="glyphicon glyphicon-phone"></span>&nbsp;
<?php echo $phoneno;?>
</p>
<p><span class="glyphicon glyphicon-tower"></span>&nbsp;
<?php if (empty($landmark)){echo "nearest landmark unavailable";} else{ echo $landmark;}?>
</p>

<p><span class="glyphicon glyphicon-home"></span>&nbsp;
The room is <?php echo $furnish;?></p>

<p><span class="glyphicon glyphicon-user"></span>&nbsp;
I am looking for a <?php echo $looking;?>  </p>

<p><span class="glyphicon glyphicon-info-sign"></span>&nbsp;
<?php if(empty($discription)){echo"Room discription unavailable";}else{ echo  $discription;}?>
</p>

</div>
</div>
</div>

</div>
</div>
</p>	
<?php } ?>

</div>
</div>



 
 
 
 
 
 
<?php include("footer1.php");?>
