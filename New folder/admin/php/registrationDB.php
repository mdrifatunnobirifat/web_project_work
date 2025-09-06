<?php
$host="localhost";
$user="root";
$password="";
$db="university management system";
$conn=mysqli_connect($host,$user,$password,$db);
if($conn-> connect_error){
    die("connection error".$conn-> connect_error);
}

?>

