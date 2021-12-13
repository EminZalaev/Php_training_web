<?php 
include 'dbconnect.php';
$sql = "SELECT * FROM zalaev.unit;";
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
		<td align = center> Unit ID</td> 
		<td align = center> Unit Name</td> 
	</tr> 
	<?php foreach ($zakazy as $zakaz):?> 
	<tr> 
		<td align = center> <?php echo $zakaz['unit_id']; ?> </td>
		<td align = center> <?php echo $zakaz['unit_name']; ?> </td>
	</tr> 
	</tbody> 
	<?php endforeach; ?> 
</table><br>
</body>
</html>