<?php
try
{
	$result = $pdo->query($sql);
	$numb = $result->rowcount();
}
catch (PDOException $e)
{
	$output = "Getting data error. ".$e->getMessage();
	exit();
}