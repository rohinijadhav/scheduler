<html>
<head>
	<title>Add Job</title>
</head>
<body>
<?php

	$con = mysqli_connect("localhost", "root", "root", "scheduler");
	
	$sql= "show databases";

	$result = mysqli_query($con,$sql);
?>
	<h2 align="center">Add Job</h2><hr>
	<form action="#" method="POST">
		<table align = "center">
		<tr>
			<td>
				<b>select Database:</b>
			</td>
			<td>
				<select name="dbname">

<?php	
				while($row = mysqli_fetch_array($result))
				{
					echo "<option value = '".$row['Database']."'>".$row['Database']."</option>";
				}
		
?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<b>Job Name:</b>
			</td>
			<td>
				<input type="text" name='jname'>
			</td>	
		</tr>
		<tr>
			<td>
				<b>SQL Query:</b>
			</td>
			<td>
				<textarea name="query"></textarea>
			</td>	
		</tr>
		<tr>
			<td>
				<input type="submit" name="submit" value="submit">
			</td>
		</tr>	
		</table>
	</form>
</body>
</html>

<?php 
$db = $_POST['dbname'];
$job = $_POST['jname'];
$query = $_POST['query'];

if(isset($_POST['submit']))
{
	$sql_c = "CREATE PROCEDURE $db.$job() BEGIN $query; END;";
	
	mysqli_query($con,$sql_c) or die(mysql_error());
	
}

?>
