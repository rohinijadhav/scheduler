<html>
<head>
	<title>Add Event</title>
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript">
	$=jquery;
	function change(db)
	{
		 $.getJSON("listbox.php",{dbname:db}, function(result){ $("#box").html(result.output)});
	}
	</script>
</head>
<body>
<?php
	
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
	$sql_db = "show databases";

	$result_db = mysqli_query($con,$sql_db) or die("Error in query:".mysqli_error($con));
?>
	<h2 align="center">Add Event</h2><hr>
	<form action="#" method="POST">
	<table align = "center">
	<tr>
			<td><b>select Database:</b></td>
			<td>
			<select name="dbname" onchange="change(this.value);">
			<option value="0" selected>----select----</option>
<?php	
			while($row = mysqli_fetch_array($result_db))
			{
				echo "<option value = '".$row['Database']."'>".$row['Database']."</option>";
			}
?>			</select>
		<tr id="box">			
		</tr>
		<tr><td><b>Event Name:</b></td>
			<td><input type="text" name="ename"></td>
		</tr>
		<tr><td><b>Schedule On:</b></td>
			<td><select name="schedule">
				<option value="EVERY">EVERY</option>
				<option value="AT">AT</option>
				</select>
			<input type ="text" name="num"> </td>
			<td><select name="interval">
					<option value="YEAR">YEAR</option> 
					<option value="MONTH">MONTH</option> 
					<option value="DAY">DAY</option> 
					<option value="HOUR">HOUR</option> 
					<option value="MINUTE">MINUTE</option> 
					<option value="WEEK">WEEK</option> 
				</select></td>
		</tr>
		<tr>
			<td><b>Start time:</b></td>
			<td><input type="text" name="start"></td>
		</tr>	
		<tr>
			<td><b>End time:</b></td>	
			<td><input type="text" name="end"></td>	
		</tr>

		<tr>
			<td><input type="submit" name="submit" value="Add"></td>
		</tr>
	</table>
</form>
<?php if(isset($_POST['submit']))
	{
		if($_POST['schedule']=='EVERY')
		{
			if(($_POST['start'] != NULL) AND ($_POST['end'] != NULL))
			{	
				$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' ENDS '$_POST[end]' DO CALL $_POST[dbname].$_POST[jobname]";	
			}
			elseif (($_POST['start'] != NULL) AND ($_POST['end'] == NULL)) 
			{
				$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' DO CALL $_POST[dbname].$_POST[jobname]";	
			}
			else
			{
				$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] DO CALL $_POST[dbname].$_POST[jobname]";	
			}

		}
		else
		{
			$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] '$_POST[start]' DO CALL $_POST[dbname].$_POST[jobname]";			
		}
		mysqli_query($con,$sql) or die("error:".mysqli_error());
		//header('Location: index.php');
	}
?>
	</body>
</html>

