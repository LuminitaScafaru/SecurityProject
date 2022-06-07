<?php 
  
	session_start();
	$errors = array(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	  if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	  }
?>
<!-- aggiungere pulsante login -->
<!DOCTYPE html>
<html>
	<head>
		<title>Ask a question</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div>
			<?php  if (isset($_SESSION['username'])) : ?>
				<p>You are <strong><?php echo $_SESSION['username']; ?></strong></p> 
				<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
			<?php endif ?>
		</div>
		<div class="header">
			<h2>Ask a question</h2>
		</div>
			
		<form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>Title</label>
				<input type="text" name="titleQ"  maxlength="300">
			</div>
			<div class="input-group">
				<label>Body</label>
				<textarea  name="bodyQ"></textarea>
			</div>
		
			<div class="input-group">
				<button type="submit" class="btn" name="sub_question">Submit your question</button>
			</div>
		</form>
		<?php
        
            if( isset( $_POST["sub_question"] ) )
            {

                function valid($data){
                    $data=trim(stripslashes(htmlspecialchars($data)));
                    return $data;
                }
                $titleQ = valid( $_POST["titleQ"] );
                
                $titleQ = addslashes($question); //aggiunge delle \ quando ci sono ' " \
                $q = "SELECT * FROM question WHERE question = '$question'";
                $result = mysqli_query($conn,$q);
                if(mysqli_error($conn))
                    echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                else if( $no == "Category"){
                    echo "<script>window.alert('Choose a Category.');</script>";
                }
                else if( mysqli_num_rows($result) == 0 ){
                    $query = "INSERT INTO quans VALUES(NULL, '$question', NULL,'".$_SESSION['user']."',NULL)";
                    $query1 = "INSERT INTO quacat SELECT q.id, c.name FROM quans as q, category as c WHERE q.question = '".$question."' AND c.name = '".$_POST['cat']."'";
                    mysqli_query( $conn, $query);
                    if(mysqli_query( $conn, $query1)){
                        echo "<style>#sf{display: none;} #ask-ta{display:block;}</style>";
                    }
                    else{
                        echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                    }
                }
                else{
                    echo "<script>window.alert('Question was already Asked. Search it on Home Page.');</script>";
                }
                
                mysqli_close($conn);
            }
        
        ?>
	</body>
</html>