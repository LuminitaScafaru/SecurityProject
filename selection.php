<?php 

	
	//include_once('connect.php');
	//session_start(); 
	include_once('server.php');

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: index.php");
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php if (isset($_SESSION['titleQ'])) : echo $_SESSION['titleQ'];  else: ?>Username <?php echo $_SESSION['username']; endif?></title> <!-- view the question -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		
	</head>

	<body >

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
	
	<div  class="content">
		<h2 style="text-align: center;">View the question</h2>
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
		  <div class="error success" >
			<h3>
			  <?php 
				echo $_SESSION['success']; 
				unset($_SESSION['success']);
			  ?>
			</h3>
		  </div>
		<?php endif ?>
		
		<br><br>
		<?php 

            $number = $_GET["number"];

            $sql = "SELECT * FROM question WHERE number =" . $number;

            $result = $db->query($sql);
            
        ?>

<div class="contentt">

    
                              
<div class="container">
	<table class="table" style="margin: auto; border-top:none;" >
		<thead>
            <tr>
                <th scope="col"  style="border:none;">Question</th>
                <th scope="col"  style="border:none;"> </th>
                <th scope="col"  style="border:none;">From</th>
            </tr>
		</thead>
		<tbody> 

         <?php
        
       
        
            while ($row = $result-> fetch_assoc()){
                    
                    
                    
                    echo " <tr>   
                        <td> <span style='font-size: 18px;'>" .$row["titleQ"]."</span></td> 
                        <td> <span>" .$row["bodyQ"]."</span></td> 
                        <td><b>" .$row["username"]."</b></td> 
                    </tr>";
            }
        ?>
                            
                                      
        </tbody>
    </table>
    
<br> 
    <b><p>Answers</p> </b>

                <?php 
                    
                    $sql2 = "SELECT answer.answerQ, answer.username FROM answer, question WHERE question.number = " . $number . " and answer.quesNum = question.number";
                    $result2 = $db->query($sql2);
                    
                    if($result->num_rows >= 1) {
                            while ($row2 = $result2-> fetch_assoc()){
                                echo "<b><span>".
                                
                                $row2['username'] . "</span></b>: "
                                    . $row2['answerQ'] . " </br> <br>";
                            }
                        }
                        else {
                            echo "Be the first one to comment!";
                        }
                        $db->close();
                    
                    ?>
                </div> 
            </div>
                    
                    <?php
                        if (isset($_SESSION["username"])){
                            echo     "<div class='contentt'>
                                        <div id='form'>
                                                    <div class='col-lg-7 mx-auto'>
                                                        <div class='card mt-2 mx-auto p-10 bg-light'>
                                                        <div class='text-center mt-5'>
                                                            <p id='' style='font-size: 20px;'> <strong> Your answer:</strong></p>
                                                        </div>
                                                            <div class='card-body bg-ligh'>
                                                                <div class='container-fluid'>
                                                                    <form action='answer.php?number=" .$number. "' method='POST' id='comment-form' role='form'>
                                                                        <div class='controls'>
                                                                            <div class='row'>
                                                                                <div class='col-md-12'>
                                                                                    <div class='form-group'> <label></label> <input type='text' name='answerQ' class='form-control' placeholder='You can write your answer here' required='required' data-error='Comment is required.'> </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                            <div class='text-center mt-3'>
                                                                                <button type='submit' class='btn btn-primary btn-block' name='submit'>Post your answer!</button> 
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                        }
                        else {
                            echo "<div class='text-center mt-3'>
                            <p>You must be <a href = 'login.php'>logged in</a> to comment!</p>
                                                                            </div>";
                        }
                                

                        ?>
    

    
    
    
		
	</div>
		
	</body>
</html>