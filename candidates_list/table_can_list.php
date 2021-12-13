<?php 
include 'dbconnect.php';
session_start();
try{
		$s = $_SESSION['interview_id'];
		$sql = "SELECT interview_id FROM zalaev.interview
		WHERE interview_id=$s;";
	    $result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$output = 'UNKNOWN ERR. '.$e->getMessage();
		include $_SERVER['DOCUMENT_ROOT'].'/LAB3/exit.php';
		exit();
	}
	$row = $result->fetch();
	$index_intid = $row['interview_id']; echo $index_intid, "(LAST INT_ID). ";
	$_SESSION['int_id'] = $index_intid;
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
	<tr style = "color: black"> 
		<td align = center> Taken Candidate Name</td> 
	</tr> 
	<?php foreach ($zakazy as $zakaz):?> 
	<tr> 
		<td align = center> <?php echo $zakaz['cname']; ?> </td>
	</tr> 
	</tbody> 
	<?php endforeach; ?> 
</table><br>
</body>
</html>