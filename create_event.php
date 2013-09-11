<?php

$con = mysqli_connect("localhost", "root", "root", "scheduler");
$sql = "CREATE EVENT phpeventcall ON SCHEDULE EVERY 1 MINUTE DO call world.job_city";

$result = mysqli_query($con,$sql);

echo $result;
?>
