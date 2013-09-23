<?php

$dbname = $_POST['dbname'];
$jobname = $_POST['jobname'];

$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
$sql = "DROP PROCEDURE $dbname.$jobname; delete from jobschedule where DBName = '$dbname' AND JobName = '$jobname'";

mysqli_multi_query($con,$sql) or die("Error in Query:".mysqli_error($con));
	
?>
