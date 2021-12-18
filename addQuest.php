<?php
	session_start();	
	
	


	if(isset($_SESSION['successQ'])){
		$title = $_GET['title'];
		$body = $_GET['body'];
		
		

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