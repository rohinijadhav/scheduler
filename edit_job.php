<html>
<head>
	<title>Add Job</title>
	
</head>
<body>
<form action="batches.php" method="POST">
<?php

	$dbname = $_GET['dbname'];
	$jobname = $_GET['jobname'];
	
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
	$sql = "show create procedure $dbname.$jobname"; 
	$result = mysqli_query($con,$sql) or die("Error in Query:".mysqli_error($con));
	
	while($row = mysqli_fetch_array($result))
	{

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
		<td><input type="text" id="query" name="query" value="<?php echo trim(substr($row[2],strpos($row[2],"BEGIN")+6),"END"); ?>"></td>
		</tr>
		<tr>
		<td><input type="submit" name="submit" value="Edit"></td>
		</tr>
	</table>
	</form>

<?php
 }		
?>
	</body>
</html>	