<?php
	session_start();	
	// define variables and set to empty values
	$name = $email = $gender = $comment = $website = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = test_input($_POST["name"]);
		$email = test_input($_POST["email"]);
		$website = test_input($_POST["website"]);
		$comment = test_input($_POST["comment"]);
		$gender = test_input($_POST["gender"]);
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
		


	if(isset($_SESSION['successQ'])){
		$title = $_GET['titleQ'];
		$body = $_GET['bodyQ'];
		

		$sql = "INSERT INTO question (title, body) VALUES(?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$title, $body]);
		if($result){
			/*echo 'Successfully saved.';*/
			header("location:index.php?status=QuestionAdded");
		}else{
			echo 'There were erros while saving the data.';
		}
		
	}else{
		echo 'No data';
	}
		
	
	
	
?>