<?php
	ini_set('display_errors', 0);
	error_reporting(~1);

	require_once('php-sql-parser.php');

	require_once('php-sql-creator.php');
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
	
	function check_for_fatal()
	{
    	$error = error_get_last();
    	if ( $error["type"] == E_ERROR )
        	log_error( $error["type"], $error["message"], $error["file"], $error["line"] );
        echo "error";
	}

	register_shutdown_function( "check_for_fatal" );
	set_error_handler( "log_error" );
	set_exception_handler( "log_exception" );
	ini_set( "display_errors", "off" );
	error_reporting( E_ALL );
	
	try
	{
		if((!$parser) OR (!$creator) OR (!$query))
		{
			 throw new Exception("Error in query");
		}

	$sql_c = "DROP PROCEDURE IF EXISTS $db.$job; CREATE PROCEDURE $db.$job() BEGIN $query; END;";

	mysqli_multi_query($con,$sql_c) or die(mysqli_error()."error");
	
	header('Location:batches.php');	
	}

	catch(Exception $e)
  	{
  		echo 'Message: ' .$e->getMessage();
  	}
	//print_r($parsed);


	
}

?>
