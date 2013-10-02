<?php
/*
DELIMITER //
mysql> DROP PROCEDURE IF EXISTS world.job;
    -> CREATE PROCEDURE world.job()
    -> BEGIN
    -> INSERT INTO total(Population) SELECT SUM(Population) from Country;
    -> END //
*/
    $dir ='./file_job/';

	if(file_exists($dir))
	{
      	$file_cnt= array_diff( scandir($dir), array(".", "..") );
		
		if(($num = count($file_cnt)) !== 0)
		{
			/*
			$dh = opendir($dir);
      
      		while (($file = readdir($dh)) !== false) 
     		{
 	      		echo "<A HREF=$dir$file>$file</A><BR>\n";
			}
	    	closedir($dh);
	    	*/
			echo $num;
			
			$con =mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection".mysqli_error());

			$query ="INSERT INTO world.total(Population) SELECT SUM(CI.Population) FROM world.City CI,world.Country CO WHERE CI.CountryCode = CO.Code";
			
			$query1 ="DROP PROCEDURE IF EXISTS world.job; CREATE PROCEDURE world.job() BEGIN $query; END;";
			mysqli_multi_query($con,$query1) or die("Error in query:".mysqli_error());

			$con =mysqli_connect("localhost", "root", "root", "scheduler") or die("Error in Connection".mysqli_error());
			
			//$query3 ="CREATE TRIGGER ins_sum BEFORE INSERT ON total FOR EACH ROW SET @sum = @sum + NEW.Population";
			//mysqli_query($con,$query3) or die("Error in trigger:".mysqli_error());
			//set @sum = 0;
			//setect @sum as 'Total_Population';

			$query2 ="call world.job";
			mysqli_query($con,$query2) or die("Error in call:".mysqli_error());
		}	
	}
	else
	{
		echo "no folder";
	}	
<<<<<<< HEAD
?>    
=======
?>    
>>>>>>> 371443c14b82b539ce366cc2f333aebcca697373
