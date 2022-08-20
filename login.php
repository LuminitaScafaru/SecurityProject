
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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

<body  style=" text-align: center;">
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
	
	<h2>Login</h2>
	
	<form style="align: center; " method="post" action="login.php" class="center">
		<div class="mb-3">
			<label for="inputUsername" class="form-label">Username</label>
			<input type="text" class="form-control" id="inputUsername" name="username">
			
		</div>
		<div class="mb-3">
			<label for="inputPassword" class="form-label">Password</label>
			<input type="password" class="form-control" id="inputPassword" name="password">
		</div>
		
		<button type="submit" class="btn btn-primary" name="login_user">Login</button>
	</form>


  	<!--<form style="align: center;" method="post" action="login.php">
		<?php// include('errors.php'); ?>
		<div style=" text-align: center;" class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
 	</form>-->
	 <?php if(isset($_POST['login_user'])) {
			$_SESSION['username'] = $_POST['username'];
		}  
		/*$username = $_POST['username']; 
		$_SESSION["username"] = $_POST['username'];*/
	?>
</body>
</html>