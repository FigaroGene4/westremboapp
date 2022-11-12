<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		
		$firstNameClient = $_POST['firstNameClient'];
		$lastNameClient = $_POST['lastNameClient'];
		$userNameClient = $_POST['userNameClient'];
		$contactNumberClient = $_POST['contactNumberClient'];
		$emailClient = $_POST['emailClient'];
		$passwordClient = $_POST['passwordClient'];
		$addressClient = $_POST['addressClient'];
		$birthdateClient = $_POST['birthdateClient'];
		$genderClient = $_POST['genderClient'];
		$joinDateClient = $_POST['joinDateClient'];

		$sql = "INSERT INTO table_client (firstNameClient, lastNameClient, userNameClient,
		 contactNumberClient, emailClient, passwordClient, addressClient, birthdateClient, genderClient, joinDateClient)
		 VALUES ('$firstNameClient', '$lastNameClient', '$userNameClient', '$contactNumberClient',
		'$emailClient','$passwordClient','$addressClient', '$birthdateClient', '$genderClient', '$joinDateClient')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Member added successfully';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }		
		//////////////
		
		else{
			$_SESSION['error'] = 'Something went wrong while adding';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: client.php');
?>