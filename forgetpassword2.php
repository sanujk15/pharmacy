<?php
include_once("db_connect.php");
include_once("sanitizationProcess.php");
include_once("mailFunction.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_email = htmlspecialchars($_POST['email']);
	
	$sanitization = new sanitizationProcess;
    $user_email = $sanitization->sanity_check($user_email);


	$sql = "SELECT * FROM login WHERE email='$user_email'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$result_length = mysqli_num_rows($resultset);

	if($result_length == 1){
		/* fetch associative array */
	    while ($row = $resultset->fetch_assoc()) {
	        $token= $row['token'];
	        $id = $row['id'];
	    }

		$updateQuery = "UPDATE login SET resetpass=1 WHERE id='$id'";
		mysqli_query($conn, $updateQuery);
		if (! mysqli_query($conn, $updateQuery)) {
			echo "error_reset";
            exit(0);
		}

		$from="medicaldirects@gmail.com";
		$fromname="Pharmacy";
		$subject="Please Reset Your Password";
		$resetUrl = 'http://localhost/pharmacy/src/resetpassword.php?email='.$user_email.'&token='.$token;

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
					    	<h1>Dear Customer, Please click on the below link to reset your password:</h1>
					    	<a href="'.$resetUrl.'" target="_blank">Reset Password</a>
					  		</div>
						</body>
					</html>';

		$to=$user_email;

		// die("test");

		$mailsend = authSendEmailWithCC($from,$fromname, $to, $subject, $message);

		if($mailsend == "success"){
			echo "success";
		} else {
			echo "Email not sent successfully,Please try again later";
		}
	}else{
		echo "invalid";
	}
	die;
}
?>