<?php
	session_start();
	
	if(isset($_POST['send']))		
	{	
		echo "zapros. ";
		include 'zap1.php';
		exit();
	}
	
	include 'input_form.html';
?>