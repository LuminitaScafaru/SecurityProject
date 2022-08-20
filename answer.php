<?php 
session_start();

include_once 'connect.php';

$number = $_GET["number"];
$answer = $_POST["answerQ"]; 
$username = $_SESSION["username"];

$conn = mysqli_connect($server,$user,$password,$db) or die("unable to connect");



    $sql = "INSERT INTO answer (answerQ, quesNum, username ) VALUES ('$answer', '$number','$username')";



    $query = mysqli_query($conn, $sql);

    header("location: selection.php?number=" .$number);



    
        
         ?>