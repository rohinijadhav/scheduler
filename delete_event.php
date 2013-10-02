<?php

echo $event=$_POST['ename'];

$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
$sql = "DROP EVENT $event"; 

mysqli_multi_query($con,$sql) or die("Error in Query:".mysqli_error($con));

<<<<<<< HEAD
?>
=======
?>
>>>>>>> 371443c14b82b539ce366cc2f333aebcca697373
