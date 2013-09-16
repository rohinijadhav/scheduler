<html>
<head>
	<title>Add Job</title>
	
</head>
<body>
<form action="#" method="POST">
<?php

	$dbname = $_POST['dbname'];
	$jobname = $_POST['jobname'];

	$con = mysqli_connect("localhost", "root", "root", "scheduler");
	
	//$sql= "select * from jobschedule where DBName LIKE 'world' AND JobName LIKE 'job_city'";

	$sql = "show create procedure $dbname.$jobname"; 
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result))
	{

	//print_r($row);
?>
	<table align="center">
		<tr>
		<td>Database</td>
		<td><input type="text" id="dbname" name="dbname" value="<?php echo $dbname; ?>" readonly></td>
		</tr>
		<tr>
		<td>Job</td>
		<td><input type="text" id="jname" name="jname" value="<?php echo $row[0]; ?>" readonly></td>
		</tr>
		<tr>
		<td>Query</td>
		<td><input type="text" id="query" name="query" value="<?php echo $query = trim(substr($row[2],strpos($row[2],"begin")+6),";end"); ?>"></td>
		</tr>
		<tr>
		<td><input type="submit" name="submit" value="Edit"></td>
		</tr>
	</table>
	</form>

	<?php 
	if(isset($_POST['submit']))
	{
		$sql_edit = "ALTER PROCEDURE $dbname.$jobname() BEGIN $query END;";
		mysqli_query($con,$sql_edit);
	}
	} 
		
		?>
	</body>
</html>	
