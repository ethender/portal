<?php
	session_start();
	require 'connect.php';
	
	
	$database = new connect();
	
	
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$pass1 = htmlspecialchars($_POST['password1']);
	$pass2 = htmlspecialchars($_POST['passsword2']);
	
	
	 $valid = checkValidation($email,$pass1,$pass2);
	 
	 
	 if($valid){
	 	
	 	/*
	 	 * all valid ok then process the account
	 	 */
	 	$query = "INSERT INTO users(name,email,password,active)VALUES('$username','$email','$pass1','0')";
	 	$resultQuery = mysql_query($query);
	 	$id = mysql_insert_id();
	 		
	 		// if inserted to database
	 		if($resultQuery == 1){
	 			$_SESSION['id'] = $id;
	 			header("Location:forwardPage");
	 		}else{
	 			session_abort();
	 			header("Location:backPage?msg= sorry not account not created");
	 		}
	 }else{
	 	header("Location:backPage?msg=not valid");
	 }
	 
	 
	 /*
	  * checking  email and passwords are same
	  */
	 function checkValidation($mail, $pass, $rpass){
	 	$checkMail = validateMail($mail);
	 	$checkPass = validatePass($pass,$rpass);
	 
	 	
	 	//checking email in the database
	 	if($checkMail === true){
	 					
	 					// checking passwords
	 					if($checkPass === true){
	 							return true;
	 					}else{
	 						header("Location:page.php?msg=check password");
	 					}
	 		
	 		
	 	}else{
	 		header("Location:page.php?msg=email already registered");
	 	}
	 }
	 
	 
	 /*
	  * checking for the mail in the database
	  */
	 function  validateMail($mail){
	 	$database = new connect();
	 	$query = "SELECT * FROM users WHERE email='$email'";
	 	$resultQuery = mysql_query($query);
	 	$result = true;
	 	if(mysql_num_rows($resultQuery) == 1){
	 		$result = false;
	 	}
	 	
	 	return $result;
	 }
	 
	 /*
	  * checks the password 
	  */
	 function validatePass($pas1,$pas2){
	 	if($pas1 === $pas2){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }

?>