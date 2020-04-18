<?php
if($_GET['token'] && $_GET['email']){
	include_once("db_connect.php");
	$token = $_GET['token'];
	$sql = "SELECT token FROM login WHERE token='".$token."' AND email ='".$_GET['email']."'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$result_length = mysqli_num_rows($resultset);

	if($result_length == 1){
		$updateQuery = "UPDATE login SET verified=1 WHERE token='$token'";
		if (mysqli_query($conn, $updateQuery)) {
			//redirect to login page
			header('location: login.php?ver=success');
            exit(0);
		}else{
			header('location: login.php?ver=failed');
	        exit(0);
		}

	}else{
		header('location: login.php?ver=failed');
        exit(0);
	}
}else{
	header('location: login.php');
    exit(0);
}
?>