<?php

$result=array();
$result['output']='';

switch ($_GET['sch_type']) {
	case 'EVERY':
		
$result['output'].='<table align ="center"><tr>';
$result['output'].='<td><input type="radio" name="interval" value="HOUR"><b>HOUR</b></td>';
$result['output'].='<td><input type="radio" name="interval" value="DAY"><b>DAY</b></td>'; 
$result['output'].='<td><input type="radio" name="interval" value="WEEK"><b>WEEK</b><td>';
$result['output'].='<td><input type="radio" name="interval" value="MONTH"><b>MONTH</b></td>'; 
$result['output'].='</tr>';
$result['output'].='<tr><td><b>Interval</b></td>';
$result['output'].='<td><input type ="text" name="num"></td></tr>';
$result['output'].='<tr>';
$result['output'].='<td><b>Start time:</b></td>';
$result['output'].='<td><input type="text" name="start"></td>';
$result['output'].='</tr>';	
$result['output'].='<tr>';
$result['output'].='<td><b>End time:</b></td>';	
$result['output'].='<td><input type="text" name="end"></td>';	
$result['output'].='</tr>';
$result['output'].='</table>';

		break;
	case 'AT':
$result['output'].='<table align="center">';	
$result['output'].='<tr>';
$result['output'].='<td><b>Execute At:</b></td>';	
$result['output'].='<td><input type="text" name="execute"></td>';	
$result['output'].='</tr>';
$result['output'].='</table>';
		break;	
	default:
	
		break;
}
echo json_encode($result);
?>
				
