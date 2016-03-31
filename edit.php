<?php

	require_once("config.php");
	
	
	if(!isset($_GET["edit"])){
		//redirect user 
		echo "redirect";
		header("Location: table.php");
		exit(); //dont execute further
	}else{
		echo "User want to edit row:".$_GET["edit"];
	}
	
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_dmibre");
		
	$stmt = $mysql->prepare("SELECT id, recipient, message FROM messages_sample WHERE id=?");
	
	echo $mysql->error;
	
	//replace the ? mark
	$stmt->bind_param("i", $_GET["edit"]);
	
	//bind result data
	$stmt->bind_result($id, $recipient, $message);
	
	$stmt->execute();
	
	//we have only 1 row of data
	if($stmt->fetch()){
		
		//we had data
		echo $id." ".$recipient." ".$message;
		}else{
			//something went wrong
			echo $stmt->error();
		}
?>
<br>
<a href="table.php">table</a>
<h2> First application </h2>

<form method="get">
	<label for="to">to:* <label>
	<input type="text" name="to"><br><br>
	
	<label for="message">Message:* <label>
	<input type="text" name="message"><br><br>
	
	<!-- This is the save button-->
	<input type="submit" value="Save to DB">

<form>

<p>Idea</p>