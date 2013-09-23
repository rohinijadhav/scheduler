<html>
<head>
	<title>Edit Event</title>
</head>
<body>
<?php
	
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
	if ($_POST['check'] == '0') 
	{
		if ($_POST['status'] =='ENABLED') 
		{
			$sql_db = "ALTER EVENT $_POST[ename] DISABLE";
		}
		else
		{
			$sql_db = "ALTER EVENT $_POST[ename] ENABLE";
		}
		$result_db = mysqli_query($con,$sql_db) or die("Error in query:".mysqli_error($con));

	}

	?>

<table align="center">
	
	<tr>
		<td>Event Name:</td>
		<td><input type="text" name="e_name" value="<?php  $ename; ?>" readonly></td>
	</tr>
	<tr>
		<td>Job Name:</td>
		<td><input type="text" name="jobname" value="<?php $jname; ?>" readonly></td>
	</tr>
	
	<tr>
		<td>Schedule Time:</td>
		<td></td>
	</tr>

</table>
</body>
</html>
