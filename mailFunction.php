<?php
		//include_once("__configurationSettings-inc.php");
		//require_once "class.smtp.php";
		//require_once "class.phpmailer.php";
		require_once 'Mail/PHPMailer/class.phpmailer.php';
		require_once 'Mail/autoload/SplClassLoader.php';

	function authSendEmailWithCC($from,$fromname, $to, $subject, $message)
	{
		
		$From = $from;
		$FromName = $fromname;
		
		
		
		$Subject = $subject;
		$Body = $message;

		$mail = new PHPMailer();

		$mail->IsSMTP();  
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = "smtp.googlemail.com";
		$mail->Port = 587;  
		$mail->IsHTML(true);
		$mail->Username = "medicaldirects@gmail.com";
		$mail->Password = "sanuj1526";
		
		$mail->From     = $From;
		$mail->FromName = $FromName;
		$mail->Sender = $From;
		$mail->AddAddress($to); 
		
		$mail->WordWrap = 50;
		$mail->Priority = 3; 
		$mail->IsHTML(true);

		$mail->Subject  =  $Subject;
		$mail->Body     =  $Body;
		if(!$mail->Send())
		{
			return "error";
		}
		else
		{
			return "success";
		}
		return "error";
	}
?>