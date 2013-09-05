<html>
<head>
<title>Scheduler</title>
</head>
<body>
<h1>JOB scheduler</h1>

<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler");

$sql = "select * from jobschedule";

$result = mysqli_query($con,$sql);

?>
<table border ="1">
	<tr>
		<th>Name</th>
		<th>Country Code</th>
		<th>District</th>
		<th>Population</th>
	</tr>

<?php

	while($row = mysqli_fetch_array($result))
	{
		$dbname = $row['DBName'];
		$jobname = $row['JobName'];
		

		$sql1 = "call $dbname.$jobname";
		$result1 = mysqli_query($con,$sql1);

		while($row1 = mysqli_fetch_array($result1))
		{
?>		
			<tr>

				<td><?php echo $row1['Name']; ?></td>
				<td><?php echo $row1['CountryCode']; ?></td>
				<td><?php echo $row1['District']; ?></td>
				<td><?php echo $row1['Population']; ?></td>

			</tr>
<?php
		}	
	}
?>
	</table>
		
</body>
</html>
