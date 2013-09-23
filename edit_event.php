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
		
	}
	else
	{
		$evnt_name = $_POST['event'];
		$dbname = $_POST['dbname'];

		$sql_db = "SHOW CREATE EVENT $evnt_name";
	}

	$result_db = mysqli_query($con,$sql_db) or die("Error in query:".mysqli_error($con));

	while($row=mysqli_fetch_array($result_db))		
	{
		$detail = $row['Create Event'];
	}

//substr(strstr($detail, '.'),1);

?>	

<a href="index.php">show event</a>

<form action="index.php" method="POST">

<table align="center">
	
		<tr>
			<td><b>Event Name:</b></td>
			<td><input type="text" name="ename" value="<?php echo $evnt_name; ?>" readonly></td>
		</tr>
	
		<tr>
			<td><b>Schedule On:</b></td>
			<td>
				<select name="schedule">
					<option value="0">----select----</option>
					<option value="EVERY">EVERY</option>
					<option value="AT">AT</option>
				</select>
				<input type ="text" name="num" value="<?php if(($pos_eve = strpos($detail, ' EVERY ')) !=FALSE){ echo substr($detail, $pos_eve+7, 2);}?>"> </td>
			<td>
				<select name="interval">
					<option value="0">----select----</option>
					<option value="YEAR">YEAR</option> 
					<option value="MONTH">MONTH</option> 
					<option value="DAY">DAY</option> 
					<option value="HOUR">HOUR</option> 
					<option value="MINUTE">MINUTE</option> 
					<option value="WEEK">WEEK</option> 
				</select></td></tr>
		<tr>
			<td><b>Start time:</b></td>
			<td><input type="text" name="start" value="<?php if(($pos_start = strpos($detail, ' STARTS '))!= FALSE){ echo substr($detail, $pos_start+9, 19);} ?>"></td>
		</tr>	
		<tr>
			<td><b>End time:</b></td>	
			<td><input type="text" name="end" value="<?php if(($pos_end = strpos($detail, ' ENDS '))!= FALSE){ echo substr($detail, $pos_end+7, 19); } ?>"></td>	
		</tr>
		<tr>
			<td><b>Execute At:</b></td>	
			<td><input type="text" name="execute" value="<?php if(($pos_at = strpos($detail, ' AT '))!= FALSE){ echo substr($detail, $pos_at+5,19); } ?>"></td>	
		</tr>		
		<tr>
			<td><input type="submit" name="submit"></td>
		</tr>
</table>
	<input type="hidden" name ="jobname" value="<?php echo substr($detail, strpos($detail, ' CALL ')+6);?>" >
</form>
</body>
</html>
