$(document).ready(function(){
	$('#forgetpassword').submit(function(){

	//prevent form from submitting
	event.preventDefault();
	
	$('#email_span').hide();
	
	//name validation

	var email_pattern = /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	var email = $('#email').val();
	var email_flag = false;
	
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


	if(email_flag) {
	//setup variables
	var form = $(this),
	formData = form.serialize(),
	formUrl = "forgetpassword2.php",
	formMethod = form.attr('method')

	//send data to server
	$.ajax({
		url: formUrl,
		type: formMethod,
		data: formData,		
		success:function(data){
				//do something when ajax call is complete
				if(data == 'success'){
					$("#reset-success").show();
					$("#forgetpassword").hide();
					$('#forgetpassword')[0].reset();
				}else if("invalid"){
					  alert("You have entered email is invalid");
				}else if("error_reset"){
					  alert("Reset Password failed, Please try again later.");
				}else{
					alert(data);
				}
			}
		});
	}
	
	return false;
	
	})
})