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
		$sql_db = "SHOW CREATE EVENT $_POST[event]";
	}

$result_db = mysqli_query($con,$sql_db) or die("Error in query:".mysqli_error($con));

while($row=mysqli_fetch_array($result_db))
{
	$detail = $row['Create Event'];
}

?>
<a href="index.php">show event</a>

<table align="center">
	
	<tr>
		<td><b>Event Name:</b></td>
		<td><input type="text" name="e_name" value="<?php echo $_POST['event']; ?>" readonly></td>
	</tr>
	
	<tr><td><b>Schedule On:</b></td>
			
	<?php
		if(($pos_eve = strpos($detail, ' EVERY ')) !=FALSE)
		{
	?>			
			<td>
				<select name="schedule">
					<option value="0">----select----</option>
					<option value="EVERY" selected>EVERY</option>
					<option value="AT">AT</option>
				</select>
				<input type ="text" name="num"> </td>
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
<?php
		}
		else
		{
?>			  <td><select name="schedule">
					<option value="0">----select----</option>
						<option value="EVERY">EVERY</option>
						<option value="AT" selected>AT</option>
					</select>
				</td></tr>
			<tr>
				<td><b>Execute At:</b></td>	
				<td><input type="text" name="execute" value="<?php if(($pos_at = strpos($detail, ' AT '))!= FALSE){ echo substr($detail, $pos_at+5,19); } ?>"></td>	
			</tr>		
<?php
		}

?>			
		
		
</table>
</body>
</html>