
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
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
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
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
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
			$password_1 = valid( $_POST["password_1"] );
			$password_2 = valid( $_POST["password_2"] );
			$password = password_hash($password, PASSWORD_DEFAULT); //creates a new password hash using a strong one-way hashing algorithm
			
			/* if (empty($username)) { 
				array_push($errors, "Username is required"); }
			if (empty($email)) { 
				array_push($errors, "Email is required"); }
			if (empty($password_1)) { 
				array_push($errors, "Password is required"); } */
			
				$password = ($password_1);

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
				echo "<script>window.alert('Username Already Exist !! Try Again');</script>";
			}
			mysqli_close($conn);
		}
		
    ?>
</body>
</html>