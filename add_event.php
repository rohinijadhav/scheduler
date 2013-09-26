<html>
<head>
	<title>Add Event</title>
	<link rel="stylesheet" type="text/css" href="css/add_event.css">
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript">
	$=jquery;
	function change(db)
	{
		$.getJSON("listbox.php",{dbname:db}, function(result){ $("#box").html(result.output)});
	}
	
	function scheduling(type)
	{
		//alert(type);
		$.getJSON("schedule_type.php",{sch_type:type}, function(result){ $("#type").html(result.output)});
	}
	</script>
</head>
<body>
<?php
	
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	
	$sql_db = "show databases";

	$result_db = mysqli_query($con,$sql_db) or die("Error in query:".mysqli_error($con));
?>
<a href="index.php">show event</a>

<div id="add_body">
	<h2 align="center">Add Event</h2>

	<form action="#" method="POST">
		<table align="center">	
			<tr>
				<td><b>select Database:</b></td>
				<td><select name="dbname" onchange="change(this.value);">
					<option value="0" selected>----select----</option>
<?php	
					while($row = mysqli_fetch_array($result_db))
					{
						echo "<option value = '".$row['Database']."'>".$row['Database']."</option>";
					}
?>					</select>
				</td>
			</tr>
			<tr>
				<td>
				<div id="box">
					
				</div>
				</td>
			</tr>
			<tr>
				<td><b>Event Name:</b></td>
				<td><input type="text" name="ename"></td>
			</tr>
			<tr>
				<td><b>Schedule On:</b></td>
				<td><input type="radio" name="schedule" value="EVERY" onclick="scheduling(this.value)"><b>EVERY</b>
					<input type="radio" name="schedule" value="AT" onclick="scheduling(this.value)" ><b>AT</b></td>
			</tr></table>
			<div id ="type">
			</div>	
			
				<input type="submit" name="submit" value="Add">
	</form>
</div>

<?php
	if(isset($_POST['submit']))
	{
	switch ($_POST['schedule']) 
	{
		case 'EVERY':
			if(($_POST['start'] != NULL) AND ($_POST['end'] != NULL))
			{	
				if(($_POST['num_str']!=NULL) AND ($_POST['num_end']!=NULL))
				{
					$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' + INTERVAL $_POST[num_str] $_POST[inter_str] ENDS '$_POST[end]' + INTERVAL $_POST[num_end] $_POST[inter_end] DO CALL $_POST[dbname].$_POST[jobname]";	
				}
				elseif(($_POST['num_str']!=NULL) AND ($_POST['num_end']==NULL)) 
				{
					$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' + INTERVAL $_POST[num_str] $_POST[inter_str] ENDS '$_POST[end]' DO CALL $_POST[dbname].$_POST[jobname]";
				}
				elseif(($_POST['num_str']==NULL) AND ($_POST['num_end']!=NULL)) 
				{
					$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' ENDS '$_POST[end]' + INTERVAL $_POST[num_end] $_POST[inter_end] DO CALL $_POST[dbname].$_POST[jobname]";
				}
				else
				{	
					$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' ENDS '$_POST[end]' DO CALL $_POST[dbname].$_POST[jobname]";	
				}
			}
			elseif (($_POST['start'] != NULL) AND ($_POST['end'] == NULL)) 
			{
				if($_POST['num_str']!=NULL)
				{

					$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' + INTERVAL $_POST[num_str] $_POST[inter_str] DO CALL $_POST[dbname].$_POST[jobname]";	

				}
				else	
				{
				 	$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] STARTS '$_POST[start]' DO CALL $_POST[dbname].$_POST[jobname]";	
				} 	
			}
			else
			{
				$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] $_POST[num] $_POST[interval] DO CALL $_POST[dbname].$_POST[jobname]";	
			}

				break;
		case 'AT':
			if($_POST['num_exe']!=NULL)
			{	
				$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] '$_POST[execute]' + INTERVAL $_POST[num_exe] $_POST[inter_exe] DO CALL $_POST[dbname].$_POST[jobname]";			
			}
			else
			{

				$sql = "CREATE EVENT IF NOT EXISTS $_POST[ename] ON SCHEDULE $_POST[schedule] '$_POST[execute]' DO CALL $_POST[dbname].$_POST[jobname]";			

			}	
				break;
			default:
				echo "wrong selection";
				break;
		}
		
		mysqli_query($con,$sql) or die("error:".mysqli_error());
		header('Location: index.php');
	}
?>
	</body>
</html>

