<?php include('server.php') ?>

<?php 
	//session_start();
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
	//include('connect.php'); 
	
?>

<!DOCTYPE html>
<html>
	
	<head>
		<title>Ask a question</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</head>
	<body style="text-align:center">
		<div class="header">
			<a href="index.php" class="logo"><img src="chat.png" style="width: 45px"></a>
			<a href="index.php" class="home">Home</a>
			<a href="forum.php" class="forum">Forum</a>
			<div class="header-right">
				<?php  if (isset($_SESSION['username'])) : ?>
					<p>You are <strong><?php echo $_SESSION['username']; ?></strong></p> 
					<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
				<?php endif ?>
			</div>
		</div>
		
		
		<h2>Ask a question</h2>
	
		<form method="post" action="postingQ.php">
			<?php// include('errors.php'); ?>
			<label id="error" name="error" style="display:none"></label>
			<div class="input-group">
				<label>Question</label>
				<input type="text" name="titleQ"  >
			</div>
			<div class="input-group">
				<label>Text</label>
				<input type="text" name="bodyQ" >
			</div>
			
			<div class="input-group">
				<button type="submit" class="btn" name="sub_question">Submit your question</button>
			</div>
			<p>
				Would you like to see <a href="forum.php">Forum</a> first?
			</p>
		</form>
	
		<h3 name="username"><?php echo $_SESSION['username'] ?></h3>
		
		<?php
		/*$_SESSION['username'] = array(
			'name'=>$_POST['$username']
		);
		class Session extends Controller{
			public function StoreSession($session = null, $table = 'question'){
				if($this->con !=null){
					if($session!=null){
						$columns = implode(',', array_keys($session));
						$values = "'".implode("','", array_values($session))."'";
						$query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
						$result=$this->con->query($query_string);
						if($result){
							echo "Session data inserted Successfully";
						}
					}
				}
			}
		}
		$obj = new Session();
		$obj->StoreSession($_SESSION['username']);*/

		/*if (isset($_POST['sub_question'])) {
			$titleQ = mysqli_real_escape_string($db, $_POST['titleQ']);
			$bodyQ = mysqli_real_escape_string($db, $_POST['bodyQ']);
			$username = $_SESSION['username'];
					
			if (empty($titleQ)) {
				array_push($errors, "A title is required");
			}
			if (empty($bodyQ)) {
				array_push($errors, "Remember to give a better explanation");
			}
		
			if (count($errors) == 0) {
				
		
				$sql = "INSERT INTO 'question' ('', 'titleQ', 'bodyQ', 'username') VALUES(,'$titleQ', '$bodyQ', '$username')";
				mysqli_query($db, $sql);
				echo "<h3>Question uploaded successfully.";
				$_SESSION['titleQ'] = $titleQ;
				$_SESSION['question'] = "You have submitted correctly your question";
				header('location: ..forum.php');
			}
		}
		*/
		?>
	</body>
</html>