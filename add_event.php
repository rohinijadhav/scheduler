<html>
<head>
	<title>Add Event</title>
</head>
<body>
<?php

	$con = mysqli_connect("localhost", "root", "root", "scheduler");
	
	$sql= "show procedure status";

	$result = mysqli_query($con,$sql);
?>
	<h2 align="center">Add Event</h2><hr>

	<table align = "center">
			<tr><td><b>select job:</b></td>
			<td><select name="jobname">

<?php	
			while($row = mysqli_fetch_array($result))
			{
				echo "<option value = '".$row['Name']."'>".$row['Name']."</option>";
			}
		
?>
		</select>
		</td>
		</tr>
	</table>
</body>
</html>

