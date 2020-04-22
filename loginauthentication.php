<?php
session_start();
include_once("db_connect.php");
include_once("loginSecurity.php");

// $ip = $_SERVER['REMOTE_ADDR'];

if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION["email_login"]))
{
	 $email=htmlspecialchars($_POST['email_login']);
	 $password=htmlspecialchars($_POST['pwd_login']);

	 $checkLoginAttempts = confirmEmailAddress($email);

	 if($checkLoginAttempts == '1'){
	 	echo "Your have exceeded failed login attempts, Please reset your password";
	 	exit();
	 }
	 
	 $sql = "select * from login where email='$email'";
	 $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
	 
	
	 if($row = mysqli_fetch_assoc($resultset)){
	 	if($row['verified'] == 0){
	 		echo "Please verify your email address to login";
	 		exit();
	 	}		
		if(password_verify($password ,$row['password'])){ 
		  clearLoginAttempts($email);
		  $_SESSION['email_login']=$row['email'];
		  echo "success";
		}else{
		  addLoginAttempt($email);
		  echo "Login Failed. Invalid Username or Password";

		}
	 }else{
	 	addLoginAttempt($email);
	 	echo "Login Failed. Invalid Username or Password";
	 }
	 exit();
}
if(isset($_SESSION["email_login"])){
	echo "You are already logged in";
}
?>
