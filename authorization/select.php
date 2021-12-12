<?php 
	try 
	{
		$result=$pdo->query($sql);
		$numb=$result->rowcount();
	}
	catch(PDOException $e)
	{
		$output='Ошибка при извлечении  данных'.$e->getMessage();
		include 'err_out.php';
		exit();
	}
?>