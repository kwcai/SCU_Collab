$(document).ready(function()
{
	$("#registerbtn").click(function()
	{

		var firstname=$("#f_name").val();
		var lastname=$("#l_name").val();
		var email=$("#email").val();
		var password=$("#password").val();
		var dataString="f_name="+firstname+"&l_name="+lastname+"&email="+email+"&password="+password+"&register=";

		if($.trim(firstname).length > 0 & $.trim(lastname).length > 0 & $.trim(email).length > 0 & $.trim(password).length > 0)
		//if(!$.trim(firstname).val() || !$.trim(lastname).val() || !$.trim(email).val() || !$.trim(password).val())
		{
			$.ajax({
				type: "POST",
				url: "register.php",
				data: dataString,
				crossDomain: true,
				cache: false,
				beforeSend: function(){ $("#registerbtn").val('Submitting...');},
				success: function(data){
					if(data=="success")
					{
					alert("Your account has been registered");
					}
					else if(data=="exist")
					{
					alert("You already have an account with us");
					}
					else if(data=="failed")
					{
					alert("Something Went wrong");
					}
				}
			});
		}
		else
		{
			alert("You must fill out all the fields");
		}	
		return false;
	});
});