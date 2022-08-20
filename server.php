<?php
	session_start();

	// initializing variables
	$username = "";
	$email    = "";
	$errors=array();

	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	
	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";

	// REGISTER USER
	/*if (isset($_POST['reg_user'])) {
	  // receive all input values from the form
	  $username = mysqli_real_escape_string($db, $_POST['username']);
	  $email = mysqli_real_escape_string($db, $_POST['email']);
	  $password = mysqli_real_escape_string($db, $_POST['password']);
	  /*$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);*/

	  // form validation: ensure that the form is correctly filled ...
	  // by adding (array_push()) corresponding error unto $errors array
	  /*if (empty($username)) { array_push($errors, "Username is required"); }
	  if (empty($email)) { array_push($errors, "Email is required"); }
	  if (empty($password)) { array_push($errors, "Password is required"); }
	 
	 /* if (empty($password_1)) { array_push($errors, "Password is required"); }
	  if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	  }*/

	  // first check the database to make sure 
	  // a user does not already exist with the same username and/or email
	  /*$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	  $result = mysqli_query($db, $user_check_query);
	  $user = mysqli_fetch_assoc($result);
	  
	  if ($user) { // if user exists
		if ($user['username'] === $username) {
		  array_push($errors, "Username already exists");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "email already exists");
		}
	  }

	  // Finally, register user if there are no errors in the form
	  if (count($errors) == 0) {
		//$password = ($password_1);//encrypt the password before saving in the database
		//$password = md5($password_1);//encrypt the password before saving in the database

		$query = "INSERT INTO users (username, email, password) 
				  VALUES('$username', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now registered";
		header('location: login.php');
	  }
	}*/

	// LOGIN USER
	if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = ($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            
			$messageError = "Wrong combination of Username/Password. Please try again!";
			echo "<script type='text/javascript'>alert('$messageError');</script>";
        	//header("location: ../login.php?status=wronginfo"); 
        }
    }
  }
  
	//SUBMIT QUESTION
	/*if (isset($_POST['sub_question'])) {
		$titleQ = mysqli_real_escape_string($db, $_POST['titleQ']);
		$bodyQ = mysqli_real_escape_string($db, $_POST['bodyQ']);
		$username = mysqli_real_escape_string($db, $_SESSION['username']);
				
		if (empty($titleQ)) {
			array_push($errors, "A title is required");
		}
		if (empty($bodyQ)) {
			array_push($errors, "Remember to give a better explanation");
		}
	
		if (count($errors) == 0) {
			
	
			$sql = "INSERT INTO 'question' ('titleQ', 'bodyQ', '') VALUES('$titleQ', '$bodyQ', '$username')";
			mysqli_query($db, $sql);
			echo "<h3>Question uploaded successfully.";
			$_SESSION['titleQ'] = $titleQ;
			$_SESSION['question'] = "You have submitted correctly your question";
			header('location: forum.php');
		}
	}*/
	
  ?>
