<?php
include_once("db_connect.php");
include_once("sanitizationProcess.php");
include_once("mailFunction.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_email = htmlspecialchars($_POST['email']);
	$user_name = htmlspecialchars($_POST['name']);
	$user_password = password_hash($_POST['password'], PASSWORD_ARGON2I);
	$user_phone = htmlspecialchars($_POST['phone']);

	$sanitization = new sanitizationProcess;
    $user_email = $sanitization->sanity_check($user_email);
    $user_name = $sanitization->sanity_check($user_name);
    $user_password = $sanitization->sanity_check($user_password);
    $user_phone = $sanitization->sanity_check($user_phone);

	$sql = "SELECT email FROM login WHERE email='$user_email'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
	$result_length = mysqli_num_rows($resultset);

	if($result_length == 0){

		//---------generate token code here --------
		$token = bin2hex(random_bytes(50));
		//-----------------
		$from="medicaldirects@gmail.com";
		$fromname="Pharmacy";
		$subject="Please verify your account";
		$verfiyUrl = 'http://localhost/pharmacy/src/tokenVerification.php?email='.$user_email.'&token='.$token;

		$message='<!DOCTYPE html>
					<html lang="en">

					<head>
					 <meta charset="UTF-8">
					 <title>Verification Email</title>
					 <style>
					    .wrapper {
					      padding: 20px;
					      color: #444;
					      font-size: 1.3em;
					    }
					    a {
					      background: #0066ee;
					      text-decoration: none;
					      padding: 8px 15px;
					      border-radius: 5px;
					      color: #fff;
					    }
					 </style>
					</head>

						<body>
					  		<div class="wrapper">
					    	<h1>Thank you for signing up on our site. Please click on the below link to verify your account:</h1>
					    	<a href="'.$verfiyUrl.'" target="_blank">Verify Email!</a>
					  		</div>
						</body>
					</html>';

		$to=$user_email;

		// die("test");

		$mailsend = authSendEmailWithCC($from,$fromname, $to, $subject, $message);

		if($mailsend == "success"){
			$sql = "INSERT INTO login(`email`, `password`, `full_name`, `phone_number`, `token`, `verified`) VALUES ('".$user_email."', '".$user_password."', '".$user_name."', '".$user_phone."', '".$token."', '0')";


			if (mysqli_query($con, $sql)){
				echo "success";
				die;
			}else{
				die("database error:". mysqli_error($con)."qqq".$sql);
			}

		} else {
			echo "There is some error in email verificaition.";
		}
		die;
	}else{
		echo "duplicate";
		die;
	}
}
?>