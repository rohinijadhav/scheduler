<html>
<head>
<title>Scheduler</title>
</head>
<body>


<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler");

?>
	<!-- show Jobs(store proccedure) table -->

	<h2 align="center"> Job Details </h2>
	<table border ="1" align="center">
		<tr>
			<th>Database</th>
			<th>Name</th>
			<th>Type</th>
			<th>Definer</th>
			<th>Modified</th>
			<th>Created</th>
			<th>Security_type</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php

	$sql_job = "show procedure status";

	$result_job = mysqli_query($con,$sql_job);
	
	while($row_job = mysqli_fetch_array($result_job))
	{ 
		
?>		
		<tr>
			<td><?php echo $row_job['Db']; ?></td>
			<td><?php echo $row_job['Name']; ?></td>
			<td><?php echo $row_job['Type']; ?></td>
			<td><?php echo $row_job['Definer']; ?></td>
			<td><?php echo $row_job['Modified']; ?></td>
			<td><?php echo $row_job['Created']; ?></td>
			<td><?php echo $row_job['Security_type']; ?></td>
			<td><a href="#">Edit</a></td>
			<td><a href="#">Delete</a></td>
		</tr>
<?php

	}		

?>

	</table>
	
<p align="center"><a href="add_job.php"><input type="submit" name="submit" value="Add New"></a></p>

</body>
</html>
