<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<meta charset="UTF-8"> 
	<title>EDIT FORM</title> 
</head> 
<body align = center><br> <br><br> <br><br> 
	<form action = "?" method = "POST">
		<div align = center>
			<?php 
				$s = $_SESSION['interview_id'];
				$sql = "SELECT * FROM zalaev.interview WHERE interview_id = $s;";
				$result = $pdo->query($sql);
				$dish = $result->fetch();
			?>
			<label for = "interview_date">Date</label>
			<input type = "text" id = "intdt" name = "intdt" value = <?php echo $dish['interview_date'] ?>  name = "intdt"><br><br><br>
			<label for = "waiting_salary">Salary</label>
			<input type = "text" id = "slr" name = "slr" value = <?php echo $dish['waiting_salary'] ?> name = "slr"><br><br><br>
			<label for = "mark">Mark</label>
			<input type = "text" id = "mrk" name = "mrk" value = <?php echo $dish['mark'] ?> name = "mrk"><br><br><br>
			<label for = "unit_id">Unit</label>
			<input type = "text" id = "unid" name = "unid" value = <?php echo $dish['unit_id'] ?>  name = "unid"><br><br><br>
			
			<p><input type = "hidden" name = "interview_id" value = <?php echo $_SESSION['interview_id']; ?>>
			<input type = "submit" value="Edit" name = "Edit_Send"> 
			<input type = "reset" value="Reset" name = "rst"> 
			
			<div align = center>
			<p><a href = "controller.php">Back</a></p>
			</div>
		</div>
	</form>
</body> 
</html>