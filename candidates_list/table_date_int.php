<?php 
include 'dbconnect.php';
$sql = "SELECT * FROM zalaev.interview;";
$result = $pdo->query($sql); 
$zakazy = $result->fetchAll();
$flag = $result->rowcount(); 
?>

<html> 
<head> 
<title>Report</title>  
</head> 
<body>
	<table border = "2" bordercolor = pink align = center><tbody>
	<tr style = "color: black"> 
		<td align = center> Interview ID</td> 
		<td align = center> Date</td>
		<td align = center> Vacancy ID</td> 
		<td align = center> Unit ID</td>
	</tr> 
	<?php foreach ($zakazy as $zakaz):?> 
	<tr> 
		<td align = center> <?php echo $zakaz['interview_id']; ?> </td>
		<td align = center> <?php echo $zakaz['interview_date']; ?> </td>
		<td align = center> <?php echo $zakaz['vacancy_id']; ?> </td>
		<td align = center> <?php echo $zakaz['unit_id']; ?> </td>
	</tr> 
	</tbody> 
	<?php endforeach; ?> 
</table><br>
</body>
</html>