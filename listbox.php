<?php 

$result=array();
$result['output']='';

$result['output'].='<table>';
$result['output'].='<td><b>select job:</b></td>';
$result['output'].='<td><select name="jobname">';
	
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));

	$dbname = $_GET['dbname'];
	
	
	$sql_job ="select DBName,JobName from jobschedule where DBName LIKE '$dbname'";		
	
	$result_job = mysqli_query($con,$sql_job);

	while($row1 = mysqli_fetch_array($result_job))
	{
		$result['output'].= "<option value = '".$row1['JobName']."'>".$row1['JobName']."</option>";
	}

	
$result['output'].='</select></td></table>';


echo json_encode($result);

?>
