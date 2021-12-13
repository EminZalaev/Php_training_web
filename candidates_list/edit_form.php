<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<meta charset="UTF-8"> 
	<title>MAIN FORM</title> 
</head>
<body>
<div align = center>
<?php
	echo "<h2>LIST:</h2>";
?>
<br>
	</div><br>
	<table align = center border="1">
	<tbody>
	
	<th>Interview Date:</th>
	<th>Vacancy ID:</th>
	<th>Unit ID:</th>
	
	<?php foreach($dishes as $dish):?>
	<form action = "?Delete" method = "POST">
	<tr><td>
	<div align = center>
	<?php
		echo $dish['interview_date'],"&nbsp";?></td></div>
	<td>
	<div align = center>
	<?php
		echo $dish['vacancy_id'],"&nbsp";?></td></div>
	<td>
	<div align = center>
	<?php
		echo $dish['unit_id'],"&nbsp";?></td></div>
	
		<input type = "hidden" name = "interview_id" value = <?php echo $dish['interview_id']; ?>>
		<td><input type = "submit" class = "Delete" name = "Delete" value = "Delete"></td>
		<td><input type = "submit" name = "Edit" value = "Edit"></td>
		<td><input type = "submit" name = "Add" value = "Add"></td>
		
	</tr></form>
	<?php endforeach; ?>
	</tbody></table><br>
	<div align = center>
		<p><a href = "../main_menu/form_begin.html">Back to menu</a></p>
	</div>
</body> 
</html>