<?php
	require_once('php-sql-parser.php');

?>
<html>
<head>
	<title>Add Job</title>
	<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="jquery.validate.min.js"></script>
	<script type="text/javascript">
	function getValue()
 	 {
 		 var x=document.getElementById("jname");
 
 		 if(x!=null) {
  			alert("sucees");

  			}
  			else
  			{
  			alert("no");
  			}
  }
	</script>
</head>
<body>
<?php

	$con = mysqli_connect("localhost", "root", "root", "scheduler");
	
	$sql= "show databases";
	$parser = new PHPSQLParser();
	$parsed = $parser->parse($sql);
	print_r($parsed);
	//$result = mysqli_query($con,$sql);
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
				<input type="text" name="jname" id="jname">
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
$query = trim(preg_replace('/\s\s+/', ' ', $_POST['query']));

if(isset($_POST['submit']))
{

	$sql_c = "DROP PROCEDURE IF EXISTS $db.$job; CREATE PROCEDURE $db.$job() BEGIN $query END;";

	mysqli_multi_query($con,$sql_c) or die(mysqli_error()."error");
	
	header('Location:batches.php');
}

?>
