<?php
	session_start();
	if (!isset($_POST['act'])) 
	{ 
		include 'auth_form.html'; 
		exit(); 
	} 
	$login='fake';//фейковый пользователь, имеет права только на чтение из role
	$pass='';
	include 'dbconnect.php';//Создавать в MySQLAdministrator так: CREATE USER 'fake'@'localhost' IDENTIFIED BY '';
							//Задать права можно так: GRANT SELECT ON `zalaev`.`role` TO 'fake'@'localhost';
	$login=$_POST['rlog'];
	$password=$_POST['rpass'];//Пользователи с именами и паролями как в таблице тоже должны быть созданы CREATE USER 'ADMIN'@'localhost' IDENTIFIED BY 'PASS1';
							  //Соответственно права у них должны быть другие GRANT ALL ON `zalaev`.* TO 'ADMIN'@'localhost';
							  //Для второй роли то же самое
	$sql="SELECT rrole FROM zalaev.role WHERE rlog='$login' AND rpass='$password';" ; 

	include 'select.php';
	$numb = $result->rowcount();
		
	if($numb == 0) {
		include 'err_out.php';
		exit();
	}
	else
	{
		include 'dbconnect.php';
		$users = $result->fetchAll();
		foreach ($users as $user):
		$_SESSION['rrole']=$user['rrole'];
		endforeach;
		$_SESSION['login']=$login;
		$_SESSION['password']=$password;
		header('Location:../main_menu/form_begin.html');
		exit();
	}
?>