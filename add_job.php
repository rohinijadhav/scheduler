<?php
	ini_set('display_errors', 0);
	error_reporting(~1);

	require_once('php-sql-parser.php');
	require_once('php-sql-creator.php');
?>
<html>
<head>
	<title>Add Job</title>
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
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

	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
		
	$sql= "show databases";
	
	$result = mysqli_query($con,$sql) or die("Error in Query:".mysqli_error($con));
	
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
$query = $_POST['query'];

if(isset($_POST['submit']))
{

	$parser = new PHPSQLParser($query);
	$creator = new PHPSQLCreator($parser->parsed);
	$query = $creator->created;	

	function exception_handler($exception)
	{
		echo "<b>Exception:</b> " , $exception->getMessage();
	}

	set_exception_handler('exception_handler');
		
	try
	{
		if((!$parser) OR (!$creator) OR (!$query))
		{
			 throw new Exception("Error in query");
		}

	$sql_insert="INSERT INTO jobschedule (DBName,JobName) VALUES ('$db','$job')";
	
	mysqli_query($con,$sql_insert) or die("Error in insert".mysqli_error($con));	

	$sql_c = "DROP PROCEDURE IF EXISTS $db.$job; CREATE PROCEDURE $db.$job() BEGIN $query; END;";

	mysqli_multi_query($con,$sql_c) or die("Error in Create Procedure:".mysqli_error($con));

	header('Location:batches.php');	
	}
	catch(Exception $e)
  	{
  		echo 'Message: ' .$e->getMessage();
  	}
	
	
}

?>