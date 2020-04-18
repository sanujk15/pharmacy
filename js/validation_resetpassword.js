$(document).ready(function(){
	$('#resetpassword').submit(function(){

	//prevent form from submitting
	event.preventDefault();

	$('#password_span').hide();
	$('#password2_span').hide();

	
	//name validation
	var password_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{10,}$/;
	var passwords = $('#password').val();
	var password2_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{10,}$/;
	var passwords2 = $('#password2').val();

	var password_flag = false;
	var password2_flag = false;
	
	//password validation	
	if(passwords == ''){
		$('#password_span').text("Password is required");
		$('#password_span').addClass("error");
		$('#password_span').show();
		password_flag = false;
	}
	else if(password_pattern.test(passwords) && passwords.length>=10 && passwords != ''){
		$('#password_span').removeClass("error");
		$('#password_span').hide();
		password_flag = true;
	}
	else if(passwords.length<10 && passwords != ''){
		$('#password_span').text("Password should have at least 10 characters.");
		$('#password_span').addClass("error");
		$('#password_span').show();
		password_flag = false;
	}
	else if(!password_pattern.test(passwords) && passwords.length>=10 && passwords != ''){
		$('#password_span').text("Password should have 1 lower case, 1 upper case, 1 digit and 1 special character.");
		$('#password_span').addClass("error");
		$('#password_span').show();
		password_flag = false;
	}


	if(passwords2 == ''){
		$('#password2_span').text("Password is required");
		$('#password2_span').addClass("error");
		$('#password2_span').show();
		password2_flag = false;
	}
	else if(passwords != passwords2){
		$('#password2_span').text("Password do not match");
		$('#password2_span').addClass("error");
		$('#password2_span').show();
		password2_flag = false;
	}
	else{
		$('#password2_span').removeClass("error");
		$('#password2_span').hide();
		password2_flag = true;
	}
	


	if(password_flag && password2_flag) {
	//setup variables
	var form = $(this),
	formData = form.serialize(),
	formUrl = "resetpassword2.php",
	formMethod = form.attr('method')

	//send data to server
	$.ajax({
		url: formUrl,
		type: formMethod,
		data: formData,
		success:function(data){
				//do something when ajax call is complete
				if(data == 'success'){
					alert("Your password has been changed successfully, Please Login");
					window.location.href = "login.php";
					$('#resetpassword')[0].reset();
				}else if(data == "failed"){
					alert("Password Reset has been failed, Please try again.");				
				}else{
					alert(data);
					window.location.href = "forgetpassword.php";
				}
			}
		});
	}
	
	return false;
	
	})
})