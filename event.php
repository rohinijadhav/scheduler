<?php
/*
$con = mysqli_connect("localhost", "root", "root", "scheduler");
$sql = "CREATE EVENT phpeventcall ON SCHEDULE EVERY 1 MINUTE DO call world.job_city";

$result = mysqli_query($con,$sql);

echo $result;

*/
?>

<html>
<head>
<title>Scheduler</title>
</head>
<body>
<h1>JOB scheduler</h1>

<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error".mysqli_error());

$sql = "select * from jobschedule";

$result = $con->query($sql) or die("Error in query".mysqli_error());

$sql2= "SET GLOBAL event_scheduler = 1";
	
		$con->query($sql2) or die("Error in event scheduler".mysqli_error($con));
?>
<table border ="1">
	<tr>
		<th>Name</th>
		<th>Country Code</th>
		<th>District</th>
		<th>Population</th>
	</tr>

<?php
	
	while($row = mysqli_fetch_assoc($result))
	{ 
		//$con = mysqli_connect("localhost", "root", "root", "scheduler");
	
		$dbname = $row['DBName'];
		$jobname = $row['JobName'];
		
		$sql1 = "call $dbname.$jobname";
		
		$result1 =$con->query($sql1) or die("Error in second query".mysqli_error($con));

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
