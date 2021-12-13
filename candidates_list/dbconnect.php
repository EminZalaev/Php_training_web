<?php
session_start();
$dbname = "zalaev"; 
$login = $_SESSION['login']; 
$password = $_SESSION['password'];
try
{
	$pdo = new PDO("mysql:host=LocalHost; dbname=$dbname", $login, $password);
	$pdo->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "DB connected. ";
}
catch(PDOException $e)
{
	echo "DB connection error. ";
	echo $e->getMessage();
	include 'output.php';
	exit();
}
?>