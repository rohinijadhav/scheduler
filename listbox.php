<?php 

$result=array();
$result['output']='';

<<<<<<< HEAD
$result['output'].='<b>select job:</b>';
$result['output'].='<select name="jobname">';
=======
$result['output'].='<table>';
$result['output'].='<td><b>select job:</b></td>';
$result['output'].='<td><select name="jobname">';
>>>>>>> 371443c14b82b539ce366cc2f333aebcca697373
	
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));

	$dbname = $_GET['dbname'];
	
	
	$sql_job ="select DBName,JobName from jobschedule where DBName LIKE '$dbname'";		
	
	$result_job = mysqli_query($con,$sql_job);

	while($row1 = mysqli_fetch_array($result_job))
	{
		$result['output'].= "<option value = '".$row1['JobName']."'>".$row1['JobName']."</option>";
	}

	
<<<<<<< HEAD
$result['output'].='</select>';
=======
$result['output'].='</select></td></table>';
>>>>>>> 371443c14b82b539ce366cc2f333aebcca697373


echo json_encode($result);

?>
