<html>
<head>
<title>Scheduler</title>
</head>
<body>
<h1 align="center">JOB Scheduler</h1>

<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler");

$sql_event= "SET GLOBAL event_scheduler = 1";

mysqli_query($con,$sql);

?>
	<hr>

	<!-- show event(scheduler) details table -->

	<h2 align="center">Events Details</h2>
	<table border ="1" align="center">
		<tr>
			<th>Database</th>
			<th>Name</th>
			<th>Definer</th>
			<th>Time zone</th>
			<th>Type</th>
			<th>Execute at</th>
			<th>Interval value</th>
			<th>Interval field</th>
			<th>Starts</th>
			<th>Ends</th>
			<th>Status</th>
			<th>Originator</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php

	$sql_event = "show events";

	$result_event = mysqli_query($con,$sql_event);

	while($row_event = mysqli_fetch_array($result_event))
	{ 
			
?>	
		<tr>
			<td><?php echo $row_event['Db']; ?></td>
			<td><?php echo $row_event['Name']; ?></td>
			<td><?php echo $row_event['Definer']; ?></td>
			<td><?php echo $row_event['Time zone']; ?></td>
			<td><?php echo $row_event['Type']; ?></td>
			<?php
				if($row_event['Execute at'] == NULL)
				{
					echo "<td>"."Not Define"."</td>";
				}
				else
				{
					echo "<td>".$row_event['Execute at']."</td>";
				}
			?>
			<td><?php echo $row_event['Interval value']; ?></td>
			<td><?php echo $row_event['Interval field']; ?></td>
			<td><?php echo $row_event['Starts']; ?></td>
			<?php
				if($row_event['Ends'] == NULL)
				{
					echo "<td>"."Not Define"."</td>";
				}
				else
				{
					echo "<td>".$row_event['Ends']."</td>";
				}
			?>
			<td><?php echo $row_event['Status']; ?></td>
			<td><?php echo $row_event['Originator']; ?></td>
			<td><a href="#">Edit</a></td>
			<td><a href="#">Delete</a></td>
		</tr>
<?php

	}
?>

</table>
<p align="center"><a href ="add_event.php"><input type="submit" name="submit" value="Add New"></a></p>
		

</body>
</html>
