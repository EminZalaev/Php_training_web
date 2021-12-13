<?php
include 'dbconnect.php';
static $index_intdt=0;
static $index_intid;
static $index_cname;
static $index_cvac;
static $index_intvac;

session_start();

if(isset($_POST['Add']))			//PRESSED "INSERT NEW PURCHASE"
{
	if ($_SESSION['rrole']=="1"){		//ONLY FOR ADMIN
	$_SESSION['id_array'] = array();
	$_SESSION['interview_id'] = $_POST['interview_id'];
	echo "Passed. ";
	echo "Going to add. ";
	//include 'insert_can.html';
	include 'add.php';
	}
	else{
	$output = 'Oops, You Have NO Rights! ';
	include 'output2.php';
	}
	exit();
}

if (isset($_GET['out']))	//OUT
{
	include 'output.php';
    exit();
}

if(isset($_POST['Edit']))			//PRESSED "EDIT BOTTOM"
{
	if ($_SESSION['rrole']=="1"){		//ONLY FOR ADMIN
	echo "Passed. ";
	echo "Going to edit. ";
	include 'edit_s.php';
	}
	else{
	$output = 'Oops, You Have NO Rights! ';
	include 'output2.php';
	}
	exit();
}

// U P D A T I N G :

if(isset($_POST['Edit_Send']))		//RESETED DATA SENT
{	
	echo "Got data to reset. ";
	
	try 
	{
		$sql="UPDATE zalaev.interview
		SET interview_date=:intdt, waiting_salary=:slr, mark=:mrk, unit_id=:unid
		WHERE interview_id=:interview_id;";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':intdt', $_POST['intdt']);
		$s -> bindValue(':slr', $_POST['slr']);
		$s -> bindValue(':mrk', $_POST['mrk']);
		$s -> bindValue(':unid', $_POST['unid']);
		$s -> bindValue(':interview_id', $_SESSION['interview_id'], PDO::PARAM_INT);
		$s -> execute();
		echo "Line Updated. ";
	}
	catch (PDOexeption $e)
	{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
}

// I N S E R T I O N :

//FS
if(isset($_POST['FullSend']))			//RENTER INDEX SENT
{	
	echo "Got data to add. ";
	
	try 
	{
		$sql="SELECT interview_id FROM zalaev.interview
		WHERE ((TO_DAYS(interview_date))=(TO_DAYS(:intdt)));";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':intdt', $_POST['intdt']);
		$s -> execute();
	}
	catch (PDOexeption $e)
	{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	$row = $s->fetch();
	$index_intdt = $row['interview_id']; echo $index_intdt, "(CHECKED). ";
	
	if($index_intdt!=0){
		echo "WRONG DATE! ";
		include 'insert_date_int.html';
	}
	else{
		echo "CORRECT DATE! ";
		try 
		{
		$sql="UPDATE zalaev.interview
		SET interview_date=:intdt
		WHERE score='0';";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':intdt', $_POST['intdt']);
		$s -> execute();
		echo "Added. ";
		}
		catch (PDOexeption $e)
		{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
		}
		include 'insert_un.html';
	}
	exit();
}

if(isset($_POST['Adding'])) {
	$_SESSION['id_array'][$_POST['canid']] = $_POST['canid'];
	include 'add.php';
	exit();
}

if(isset($_POST['Deleting'])) {
	$_SESSION['id_array'][$_POST['delete_id']] = 0;
	include 'add.php';
	exit();
}

//FS 1
if(isset($_POST['FullSend1']))		//CANDIDATE
{	
	foreach ($_SESSION['id_array'] as $id_id):
	if ($id_id != 0) {
	$index_intid = $_SESSION['int_id'];
	$sql = "SELECT * FROM zalaev.interview WHERE interview_id = $index_intid;";
				$result = $pdo->query($sql);
				$dish = $result->fetch();
				$index_intvac = $dish['vacancy_id'];
	echo $index_intid, "Got data to add. ", $index_intvac;
	try{
		$sql = "SELECT candidate_name FROM zalaev.candidate
		WHERE candidate_id=:canid;";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':canid', $id_id);
		$s -> execute();
	}
	catch (PDOexeption $e)
	{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	$row = $s->fetch();
	$index_cname = $row['candidate_name']; echo $index_cname, "(CNAME). ";
	
	try{
		$sql = "SELECT FK_C_V FROM zalaev.candidate
		WHERE candidate_id=:canid;";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':canid', $id_id);
		$s -> execute();
	}
	catch (PDOexeption $e)
	{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	$row = $s->fetch();
	$index_cvac = $row['FK_C_V']; echo $index_cvac, "(CVACID). ";
	
	echo $index_intvac;
	
	if($index_intvac==$index_cvac){
		echo $index_cvac, $index_intvac, $index_intid;
		$sql="INSERT INTO zalaev.list
		SET FK_L_CAN=:canid, FK_L_IN=$index_intid, cname='$index_cname';";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':canid', $id_id);
		$s -> execute();
		echo "Added. ";
		try 
		{
			$sql="UPDATE zalaev.interview
			SET score=score+1
			WHERE interview_id=$index_intid;";
			$s = $pdo->prepare($sql);
			$s -> execute();
			echo "Added. ";
		}
		catch (PDOexeption $e)
		{
			$output = "Add error. ".$e->getMessage();
			include 'output.php';
			exit();
		}
	}
	else echo "WRONG CANDIDATE! ";
	}
	endforeach;
	$_SESSION['id_array'] = array();
	include 'add.php';
	exit();
}

//FS 2
if(isset($_POST['FullSend2']))			////RENT DATES SENT
{	
	echo "Got data to add. ";
	try 
	{
		$sql="UPDATE zalaev.interview
		SET unit_id=:unid WHERE score='0';";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':unid', $_POST['unid']);
		$s -> execute();
		echo "Added. ";
	}
	catch (PDOexeption $e)
	{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	include 'insert_can.html';
	exit();
}

if(isset($_POST['FullSend3']))			////RENT DATES SENT
{	
	echo "Got data to add. ";
	try {
		$sql="INSERT INTO zalaev.interview
		SET interview_date='0', score='0', waiting_salary=:slr, mark='NO', vacancy_id=:vacid, unit_id='1';";
		$s = $pdo->prepare($sql);
		$s -> bindValue(':vacid', $_POST['vacid']);
		$s -> bindValue(':slr', $_POST['slr']);
		$s -> execute();
		echo "Added. ";
		}
		catch (PDOexeption $e)
		{
		$output = "Add error. ".$e->getMessage();
		include 'output.php';
		exit();
		}
	include 'insert_date_int.html';
	exit();
}

// D E L E T E :

if(isset($_POST['Delete']))		//PRESSED "DELETE BOTTOM"
{	
	if ($_SESSION['rrole']=="1"){		//ONLY FOR ADMIN
	echo "Passed. ";
	echo "Got data to delete. ";
	
	try
	{
		$del = $_SESSION['interview_id'];
		$sql = "DELETE FROM zalaev.list WHERE FK_L_IN=:interview_id;";
		$s = $pdo->prepare($sql);
		$s->bindValue(':interview_id',$_SESSION['interview_id']);
		$s->execute();
		echo "Deleted 1. ";
	}
	catch (PDOexeption $e)
	{
		$output = "Delete error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	
	try
	{
		$del = $_SESSION['interview_id'];
		$sql = "DELETE FROM zalaev.interview WHERE interview_id=:interview_id;";
		$s = $pdo->prepare($sql);
		$s->bindValue(':interview_id',$_SESSION['interview_id']);
		$s->execute();
		echo "Deleted 2. ";
	}
	catch (PDOexeption $e)
	{
		$output = "Delete error. ".$e->getMessage();
		include 'output.php';
		exit();
	}
	}
}

$_SESSION['id_array'] = array();
$sql = 'SELECT * FROM zalaev.interview;';		//ALL FROM LINE SELECTION
include 'select.php';
$result = $pdo->query($sql); 
$dishes = $result->fetchAll();
include 'edit_form.php';

?>