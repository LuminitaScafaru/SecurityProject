
<?php 
	session_start();
	
	if(isset ($_SESSION['username'])){
		header("Location: index.php");
	}
	include('connect.php'); 
	
	//$errors = array();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<style>
		
		.center {
			margin: auto;
			width: 30%;
			
			padding: 10px;
		}
	</style>
</head>
<body style="text-align: center;">
<div class="header">
		<a href="index.php" class="logo"><img src="chat.png" style="width: 45px"></a>
		<a href="index.php" class="home">Home</a>
		<a href="forum.php" class="forum">Forum</a>
		<div class="header-right">
			<?php  if (isset($_SESSION['username'])) : ?>
				<p>You are <strong><?php echo $_SESSION['username']; ?></strong></p> <!-- si può fare un attacco -->
				<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
				<?php else: ?>
				
				<a class="active" href="login.php">LOGIN</a>
				<a href="register.php">SIGN IN</a>
			<?php endif ?>
		</div>
	</div>

	<h2>Registration</h2>
	<form style="align: center; " method="post" action="register.php" class="center">
		<div class="mb-3">
			<label for="inputUsername" class="form-label">Username</label>
			<input type="text" class="form-control" id="inputUsername" name="username" required>
			
		</div>
		<div class="mb-3">
			<label for="inputEmail" class="form-label">Email</label>
			<input type="email" class="form-control" id="inputEmail" name="email" required>
			
		</div>
		<div class="mb-3">
			<label for="inputPassword" class="form-label">Password</label>
			<input type="password" class="form-control" id="inputPassword" name="password" required onfocus=”javascript:document.getElementById(this.id).value = ”">
		</div>
		
		<button type="submit" class="btn btn-primary" name="reg_user">Register</button>
		<br><br>
		<p>
			Already a member? <a href="login.php">Login</a>
		</p>
	</form>

 <!-- <form method="post" action="register.php">
		<?php// include('errors.php'); ?>
		<label id="error" name="error" style="display:none"></label>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username"  required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" required>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1" id="password_1" required onfocus=”javascript:document.getElementById(this.id).value = ”" />
		</div>
		<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2" id="password_2" required onfocus=”javascript:document.getElementById(this.id).value = ””/>
		</div>-->
		<!--<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Login</a>
		</p>
  </form>-->
	<script>
		function controlla(){
			var mess="";
			if(document.getElementById('password_1') != document.getElementById('password_2')){
				document.getElementById('error').style.display="block";
				document.getElementById('error').innerHTML = "Passwords are not the same";
			}
		}
		
	</script>
	<?php
        
		if( isset( $_POST["reg_user"] ) ){

			function valid($data){
				$data=trim(stripslashes(htmlspecialchars($data)));
				return $data;
			}
			//$errors = array(); 
			$username = valid( $_POST["username"] );
			$email = valid( $_POST["email"] );
			$password = valid( $_POST["password"] );
			//$password_2 = valid( $_POST["password_2"] );
			//$password = password_hash($password, PASSWORD_DEFAULT); //creates a new password hash using a strong one-way hashing algorithm
			
			/* if (empty($username)) { 
				array_push($errors, "Username is required"); }
			if (empty($email)) { 
				array_push($errors, "Email is required"); }
			if (empty($password_1)) { 
				array_push($errors, "Password is required"); } */
			
				//$password = ($password_1);

				$query = "INSERT INTO users VALUES( NULL, '$username', '$email', '$password')";
				
			if(mysqli_error($conn)){
				echo "<script>window.alert('Something Goes Wrong. Try Again');</script>";
			}
	//                echo $query;
			else if( mysqli_query( $conn, $query) ){
				echo "<style>#sf{display: none;} #ta{display:block;}</style>";
			}
			else{
	//                    echo mysqli_error($conn);
				echo "<script>window.alert('Username already exists !! Try Again');</script>";
			}
			header('location: login.php');
			mysqli_close($conn);
		}
		
    ?>
</body>
</html>