<?php
	try {
		$pdo = new PDO("mysql:host=localhost; dbname=zalaev", $login, $pass);
		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	} catch (PDOException $e) {
		$output="Невозможно подключиться к БД";
		$e->getMessage();
	}
?>