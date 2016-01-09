<?php
	session_start();
	
		require 'connect.php';
		
		
		$firstName = htmlspecialchars($_POST['firstName']);
		$lastName = htmlspecialchars($_POST['lastName']);
		$dateOfBirth = htmlspecialchars($_POST['dateOfBirth']);
		$nationality = htmlspecialchars($_POST['nationality']);
		$pancard = htmlspecialchars($_POST['pancard']);
		$gender = htmlspecialchars($_POST['gender']);
		
		/*
		 * checking fields for empty
		 */
		if(!empty($firstName) && !empty($lastName) && !empty($dateOfBirth) && !empty($nationality) && !empty($pancard) && !empty($gender)){
			
			/*
			 *  updating more information of the user 
			 */
			$database = new connect();
			$id = $_SESSION['id'];
			$query = "UPDATE users SET firstName = '$firstName', lastName='$lastName', dateOfBirth='$dateOfBirth', nationality='$nationality', pancard='$pancard', gender='$gender' WHERE id='$id'";
			$resultQuery = mysql_query($query);
			
		
			if($resultQuery == 1){
				header("Location:forwardPage.php");
			}else{
				header("Location:backPage.php?msg=sorry something  is wrong");
			}
			
		}else{
			header("Location:lastPage?msg=fill all forms");
		}
		
?>