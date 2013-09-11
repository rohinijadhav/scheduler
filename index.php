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

$sql2= "SET GLOBAL event_scheduler = 1";
	
		mysqli_query($con,$sql2);
?>
<table border ="1">
	<tr>
		<th>Name</th>
		<th>Country Code</th>
		<th>District</th>
		<th>Population</th>
	</tr>

<?php
	$i=0;
	while($row = mysqli_fetch_array($result))
	{ 
		$dbname = $row['DBName'];
		$jobname = $row['JobName'];
		
		echo "outer";

		$sql1 = "call $dbname.$jobname";
		$result1 = mysqli_query($con,$sql1);

		while($row1 = mysqli_fetch_array($result1))
		{
			echo "in ";

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
