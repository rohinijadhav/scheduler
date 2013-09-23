<html>
<head>
<title>Scheduler</title>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
	$=jquery;
	function test(db,job)
	{
		 $.ajax({
                    type:'POST',
                    url:'delete_job.php',
                    data:"dbname=" + db + "&jobname=" + job,
                    success:function(data)
                    {
                        alert("success!");
                        location.reload( true );
                    }
                });
	} 

	function edit(db,job)
	{
		 $.ajax({
                    type:'GET',
                    url:'edit_job.php',
                    data:"dbname=" + db + "&jobname=" + job,
                    success:function(data)
                    {
                        alert("success!");
                        $('#edit_job').html(data);
                    }
                });
	} 
</script>
</head>
<body>


<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));
	

?>
	<!-- show Jobs(store proccedure) table -->

	<h2 align="center"> Job Details </h2>
	<table border ="1" align="center">
		<tr>
			<th>Database</th>
			<th>Name</th>
			<th>Type</th>
			<th>Definer</th>
			<th>Modified</th>
			<th>Created</th>
			<th>Security_type</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php

	$sql_job = "show procedure status";

	$result_job = mysqli_query($con,$sql_job) or die("Error in procedre Query:".mysqli_error($con));

	$i=0;
		
	while($row_job = mysqli_fetch_array($result_job))
	{ 
		
?>		
		<tr>
			<td><?php echo $db = $row_job['Db']; ?></td>
			<td><?php echo $job = $row_job['Name']; ?></td>
			<td><?php echo $row_job['Type']; ?></td>
			<td><?php echo $row_job['Definer']; ?></td>
			<td><?php echo $row_job['Modified']; ?></td>
			<td><?php echo $row_job['Created']; ?></td>
			<td><?php echo $row_job['Security_type']; ?></td>
			<td><a href="#" onclick="edit('<?php echo $db ?>','<?php echo $job ?>');">Edit</a></td>
			<td><a href="#" onclick="test('<?php echo $db ?>','<?php echo $job ?>');">Delete</a></td>
		</tr>
<?php

	}		

?>

	</table>
	
<p align="center"><a href="add_job.php"><input type="submit" name="add" value="Add New"></a></p>

<div id ="edit_job">
</div>
<?php

if(isset($_POST['submit']))
{
	$con = mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection:".mysqli_error($con));

	require_once('php-sql-parser.php');
	require_once('php-sql-creator.php');

	$parser = new PHPSQLParser($_POST['query']);
	$creator = new PHPSQLCreator($parser->parsed);
	$query = $creator->created;

	$sql_edit = "DROP PROCEDURE IF EXISTS $_POST[dbname].$_POST[jname]; CREATE PROCEDURE $_POST[dbname].$_POST[jname]() BEGIN $query; END;";
	mysqli_multi_query($con,$sql_edit) or die("Error in Qeury:".mysqli_error($con));
	
	echo "success";
}

?>
</body>
</html>
