<?php
include_once("db_connect.php");
include_once("sanitizationProcess.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = htmlspecialchars($_POST['email']);
	$token = htmlspecialchars($_POST['token']);
	$new_password = password_hash($_POST['password'], PASSWORD_ARGON2I);

	$sanitization = new sanitizationProcess;
    $email = $sanitization->sanity_check($email);
    $token = $sanitization->sanity_check($token);
    $new_password = $sanitization->sanity_check($new_password);


    $sql = "SELECT email FROM login WHERE email='$email' AND resetpass=1 AND token='$token'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
	$result_length = mysqli_num_rows($resultset);

	if($result_length == 1){
		$updateQuery = "UPDATE login SET password='$new_password', resetpass=0 WHERE email='$email'";
		mysqli_query($con, $updateQuery);
		if (mysqli_query($con, $updateQuery)) {
			$q = "UPDATE LoginAttempts SET Attempts = 0 WHERE email = '$email'";
  			mysqli_query($con, $q);

			echo "success";
		}else{
			echo "failed";
        }
	}else{
		echo "You are not allowed to reset password. Your password already changed";
	}
	die;
}