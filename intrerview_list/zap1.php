<?php 
include 'dbconnect.php';
session_start();
echo "zap1. ";
try{
		$sql = "SELECT interview_id FROM zalaev.interview WHERE interview_date=:dt;";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':dt', $_POST['dt']);
		$s -> execute();
	}
	catch (PDOexeption $e)
	{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	$row = $s->fetch();
	$index_intid = $row['interview_id']; echo $index_intid, "(id). ";

$sql = "SELECT * FROM zalaev.list WHERE FK_L_IN=$index_intid;"; 

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
	<th colspan="4" align = center style = "color: black"> <?php echo "Candidate List #", $index_intid; ?> </th> 
	<tr style = "color: black"> 
	</tr> 
	<?php foreach ($zakazy as $zakaz):?> 
	<tr> 
		<td align = center> <?php echo $zakaz['cname']; ?> </td>
	</tr> 
	</tbody> 
	<?php endforeach; ?> 
	</table><br>
	<div align = center>
		<p><a href = "index.php">Back</a></p>
		<p><a href = "../main_menu/form_begin.html">Back to menu</a></p>
	</div>
</body>
</html>