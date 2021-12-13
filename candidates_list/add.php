<!DOCTYPE html> 
<?php
if ($_SESSION['rrole'] != 1) {
	include 'controller.php';
}
?>
<?php session_start(); ?>
<html lang="en"> 
<head> 
	<meta charset="UTF-8"> 
	<title>EDIT FORM</title> 
</head> 

<body align = center><br> <br><br>
<div align = center>
<?php $s = $_SESSION['interview_id']; ?>
	<h3>CHOOSE CANDIDATES</h3> </div> <br><br>
	<?php include 'table_can_list.php'; ?>
	<?php include 'table_can.php'; ?>
	<h3>ID WAS ADDED:</h3>
		<?php foreach ($_SESSION['id_array'] as $id_id): ?>
			<?php if ($id_id != 0) { ?>
			<form action="?" method=POST>
			<?php echo $id_id;?>
			<input class="delete" type=submit  name="Deleting" value="Delete">
			<tr><input type="hidden" name="delete_id" value=<?php echo $id_id ?>></tr>
			<?php } ?>
		</form>
		<?php endforeach;?>
	
	<form action = "?" method = "POST">
		<div align = center>
			<label for = "candidate_id">Enter Candidate ID:</label>
			<input type = text id = name name = "canid">
			<input type = submit name = "Adding" value = "Add"><br><br><br>
		</div>
		<div align = center>
		<p><input type = "hidden" name = "interview_id" value = <?php echo $_SESSION['interview_id']; ?>>
			<input type = "submit" name = "FullSend1" value = "Send">
			<input type = "reset" value="Reset" name = "rst"> 
			<div align = center><br>
			<p><a href = "controller.php">FINISH</a></p>
			</div>
		</div>
	</form>
</body> 
</html>