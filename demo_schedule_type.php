<?php

$result=array();
$result['output']='';

switch ($_GET['sch_type']) {
	case 'EVERY':
		
$result['output'].='<table>';
$result['output'].='<tr><td>Interval</td>';
$result['output'].='<td><input type ="text" name="num">';
$result['output'].='<select name="interval">';
$result['output'].='<option value="YEAR">YEAR</option>' ;
$result['output'].='<option value="MONTH">MONTH</option>'; 
$result['output'].='<option value="DAY">DAY</option>'; 
$result['output'].='<option value="HOUR">HOUR</option>';
$result['output'].='<option value="MINUTE">MINUTE</option>'; 
$result['output'].='<option value="WEEK">WEEK</option>'; 
$result['output'].='</select></td>';
$result['output'].='</tr>';
$result['output'].='<tr>';
$result['output'].='<td><b>Start time:</b></td>';
$result['output'].='<td><input type="text" name="start"> + Interval <input type="text" name="num_str">';
$result['output'].='<select name="inter_str">';
$result['output'].='<option value="YEAR">YEAR</option>';
$result['output'].='<option value="MONTH">MONTH</option>'; 
$result['output'].='<option value="DAY">DAY</option>'; 
$result['output'].='<option value="HOUR">HOUR</option>'; 
$result['output'].='<option value="MINUTE">MINUTE</option>'; 
$result['output'].='<option value="WEEK">WEEK</option>'; 
$result['output'].='</select></td>';
$result['output'].='</tr>';	
$result['output'].='<tr>';
$result['output'].='<td><b>End time:</b></td>';	
$result['output'].='<td><input type="text" name="end"> + Interval <input type="text" name="num_end">';
$result['output'].='<select name="inter_end">';
$result['output'].='<option value="YEAR">YEAR</option>'; 
$result['output'].='<option value="MONTH">MONTH</option>'; 
$result['output'].='<option value="DAY">DAY</option>'; 
$result['output'].='<option value="HOUR">HOUR</option>'; 
$result['output'].='<option value="MINUTE">MINUTE</option>';
$result['output'].='<option value="WEEK">WEEK</option>'; 
$result['output'].='</select></td>';	
$result['output'].='</tr>';
$result['output'].='</table>';

		break;
	case 'AT':
$result['output'].='<table align="center">';	
$result['output'].='<tr>';
$result['output'].='<td><b>Execute At:</b></td>';	
$result['output'].='<td><input type="text" name="execute"> + Interval <input type="text" name="num_exe">';
$result['output'].='<select name="inter_exe">';
$result['output'].='<option value="YEAR">YEAR</option>'; 
$result['output'].='<option value="MONTH">MONTH</option>'; 
$result['output'].='<option value="DAY">DAY</option>'; 
$result['output'].='<option value="HOUR">HOUR</option>'; 
$result['output'].='<option value="MINUTE">MINUTE</option>'; 
$result['output'].='<option value="WEEK">WEEK</option>'; 
$result['output'].='</select></td>';	
$result['output'].='</tr>';

$result['output'].='</table>';
		break;	
	default:
	
		break;
}
echo json_encode($result);
?>
				