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
	</body>
</html>