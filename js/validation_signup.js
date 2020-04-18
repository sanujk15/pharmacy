$(document).ready(function(){
	$('#signup').submit(function(){

	
	//prevent form from submitting
	event.preventDefault();
	
	$('#username_span').hide();
	$('#password_span').hide();
	$('#password2_span').hide();
	$('#email_span').hide();
	$('#phone_span').hide();
	
	
	//name validation
	var username_pattern = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
	var username = $('#name').val();
	var password_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{10,}$/;
	var passwords = $('#password').val();
	var password2_pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{10,}$/;
	var passwords2 = $('#password2').val();
	var email_pattern = /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var email = $('#email').val();
	var phone_pattern = /^\d{10}$/;
	var phone = $('#phone').val();
	var name_flag = false;
	var email_flag = false;
	var phone_flag = false;
	var password_flag = false;
	var password2_flag = false;
	
	if(username == ''){
		$('#username_span').text("Name is required");
		$('#username_span').addClass("error");
		$('#username_span').show();
		name_flag = false;
	}
	else if(username_pattern.test(username) && username != ''){
		$('#username_span').removeClass("error");
		$('#username_span').hide();
		name_flag = true;
	}
	else if(!username_pattern.test(username) && username != ''){
		$('#username_span').text("Name can only contain characters.");
		$('#username_span').addClass("error");
		$('#username_span').show();
		name_flag = false;
	}

	
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
	
	//email validation
	if(email == ''){
		$('#email_span').text("Email is required");
		$('#email_span').addClass("error");
		$('#email_span').show();
		email_flag = false;
	}
	
	else if(email_pattern.test(email) && email != ''){
		$('#email_span').removeClass("error");
		$('#email_span').hide();
		email_flag = true;
	}
	else if(!email_pattern.test(email) && email != ''){
		$('#email_span').text("Email format: admin@domain.com");
		$('#email_span').addClass("error");
		$('#email_span').show();
		email_flag = false;
	}

	//phone validation
	if(phone == '' || !phone_pattern.test(phone) || phone.length<10 || phone.length>10){
		$('#phone_span').text("Phone Number should be digits and it should have exact 10 digits");
		$('#phone_span').addClass("error");
		$('#phone_span').show();
		phone_flag = false;
	}else{
		$('#phone_span').removeClass("error");
		$('#phone_span').hide();
		phone_flag = true;
	}

	if(password_flag && name_flag && email_flag && phone_flag && password2_flag) {
	//setup variables
	var form = $(this),
	formData = form.serialize(),
	formUrl = "register.php",
	formMethod = form.attr('method');

	//send data to server
	$.ajax({
		url: formUrl,
		type: formMethod,
		data: formData,
		success:function(data){
				//do something when ajax call is complete
				if(data == 'success'){
					$('#signup')[0].reset();
					window.location.href = "thankyouemail.php";
				}else if(data == "duplicate"){
					$('#email_span').text("Email id already exist");
					$('#email_span').addClass("error");
					$('#email_span').show();
					alert("This email id already exist");
					$('#email').focus();
					
				}else{
					alert(data);
				}
			}
		});
	}
	
	return false;
	
	})
})