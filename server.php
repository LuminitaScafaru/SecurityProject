<?php
	session_start();

	// initializing variables
	$username = "";
	$email    = "";
	7

	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	
	/*if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";*/

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
	  // receive all input values from the form
	  $username = mysqli_real_escape_string($db, $_POST['username']);
	  $email = mysqli_real_escape_string($db, $_POST['email']);
	  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	  // form validation: ensure that the form is correctly filled ...
	  // by adding (array_push()) corresponding error unto $errors array
	  if (empty($username)) { array_push($errors, "Username is required"); }
	  if (empty($email)) { array_push($errors, "Email is required"); }
	  if (empty($password_1)) { array_push($errors, "Password is required"); }
	  if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	  }

	  // first check the database to make sure 
	  // a user does not already exist with the same username and/or email
	  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
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
		$password = ($password_1);//encrypt the password before saving in the database

		$query = "INSERT INTO users (username, email, password) 
				  VALUES('$username', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	  }
	}

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
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
	//SUBMIT QUESTION
	/*if (isset($_POST['sub_question'])) {
	// receive all input values from the form
		$title = mysqli_real_escape_string($db, $_POST['title']);
		$body = mysqli_real_escape_string($db, $_POST['body']);
	}
	if (empty($title)) { array_push($errors, "A title is required"); }
	if (empty($body)) { array_push($errors, "A body of the question is required"); }
	
	if (count($errors) == 0) {
		//$password = ($password_1);//encrypt the password before saving in the database

		$query = "INSERT INTO question (title, body) 
				  VALUES('$title', '$body')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		//$_SESSION['title'] = $title;
		//$_SESSION['body'] = $body;
		$_SESSION['successQ'] = "You have submit your Question"; //da cambiare
		header('location: index.php');
	}*/
  ?>
