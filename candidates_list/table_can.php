<?php 
include 'dbconnect.php';
$sql = "SELECT * FROM zalaev.candidate;";
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
		<td align = center> Candidate ID</td> 
		<td align = center> Name</td>
		<td align = center> Vacancy ID</td>
		<td align = center> City</td> 
		<td align = center> Age</td>
		<td align = center> Sex</td>
	</tr> 
	<?php foreach ($zakazy as $zakaz):?> 
	<tr> 
		<td align = center> <?php echo $zakaz['candidate_id']; ?> </td>
		<td align = center> <?php echo $zakaz['candidate_name']; ?> </td>
		<td align = center> <?php echo $zakaz['FK_C_V']; ?> </td>
		<td align = center> <?php echo $zakaz['living_place']; ?> </td>
		<td align = center> <?php echo $zakaz['age']; ?> </td>
		<td align = center> <?php echo $zakaz['sex']; ?> </td>
	</tr> 
	</tbody> 
	<?php endforeach; ?> 
</table><br>
</body>
</html>