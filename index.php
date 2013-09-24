<html>
<head>
<title>Scheduler</title>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
	function delete_event(event)
	{
		
		$.ajax({
				type:'POST',
				url:'delete_event.php',
				data:"ename="+event,
				success:function(data){
					alert('success')
					location.reload(true)
				}
		});
	}
	
	function status(event,status)
	{	
		var id ='0';

		$.ajax({
				type:'POST',
				url:'edit_event.php',
				data:"ename="+ event +"&status="+ status +"&check=" + id,
				success:function(data){
					alert('success')
					location.reload(true);
				}
		});
	}

	function edit_event(db,event)
	{	
		var id =1;
		alert(db);
		alert(event);
	
		$.ajax({
				type:'POST',
				url:'edit_event.php',
				data:"dbname="+ db +"&event="+ event +"&check="+ id,
				success:function(data){
					alert('success')
					$('#edit_event').html(data);
				}
		});
	}
</script>
</head>
<body>
<h1 align="center">JOB Scheduler</h1>

<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
$sql= "SET GLOBAL event_scheduler = 1";

mysqli_query($con,$sql) or die("Error in Set Event Schedule:".mysqli_error($con));
	

?>
	<hr>
<div id="edit_event">
	<!-- show event(scheduler) details table -->

	<a href="batches.php" align="left">Show Jobs</a>
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
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php

	$sql_event = "show events";

	$result_event = mysqli_query($con,$sql_event) or die("Error in Query:".mysqli_error($con));
	
	while($row_event = mysqli_fetch_array($result_event))
	{ 
			
?>		<tr>
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

				if ($row_event['Interval value'] == NULL)
				{
					echo "<td>"."Not Define"."</td>";
				}
				else
				{
					echo "<td>".$row_event['Interval value']."</td>"; 
				}

				if ($row_event['Interval field'] == NULL)
				{
					echo "<td>"."Not Define"."</td>";
				}
				else
				{
					echo "<td>".$row_event['Interval field']."</td>"; 
				}	

				if ($row_event['Starts'] == NULL)
				{
					echo "<td>"."Not Define"."</td>";
				}
				else
				{
					echo "<td>".$row_event['Starts']."</td>"; 
				}	

				if($row_event['Ends'] == NULL)
				{
					echo "<td>"."Not Define"."</td>";
				}
				else
				{
					echo "<td>".$row_event['Ends']."</td>";
				}
			?>
			<td><a href="#" onclick="status('<?php echo $row_event['Name']?>','<?php echo $row_event['Status']?>');"><?php echo $row_event['Status']; ?></a></td>
			<td><a href="#" onclick="edit_event('<?php echo $row_event['Db']?>','<?php echo $row_event['Name']?>');">Edit</a></td>
			<td><a href="#" onclick="delete_event('<?php echo $row_event['Name']?>');">Delete</a></td>
		</tr>
<?php

	}
?>

</table>
<p align="center"><a href ="add_event.php"><input type="submit" name="add" value="Add New"></a></p>
</div>		

<?php
	if (isset($_POST['submit'])) 
	{
		
	switch ($_POST['schedule']) 
	{
		case 'EVERY':
			if(($_POST['start'] != NULL) AND ($_POST['end'] != NULL))
			{
				$sql_edit = "ALTER EVENT $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' ENDS '$_POST[end]' DO CALL $_POST[jobname]";			
			}
			elseif(($_POST['start'] != NULL) AND ($_POST['end'] == NULL))
			{
				$sql_edit = "ALTER EVENT $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' DO CALL $_POST[jobname]";			
			}
			else 
			{
				$sql_edit = "ALTER EVENT $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] DO CALL $_POST[jobname]";
			}
				break;
		case 'AT':
				$sql_edit = "ALTER EVENT $_POST[ename] ON SCHEDULE $_POST[schedule] '$_POST[execute]' DO CALL $_POST[jobname]";			

				break;	
			default:
				echo "wrong selection";
				break;
	}
		
		mysqli_query($con,$sql_edit) or die("Error in edit".mysqli_error());
	}
?>
</body>
</html>
