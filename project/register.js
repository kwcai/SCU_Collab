$(document).ready(function()
{
	$(#register).click(function()
	{
		var firstname=$("f_name");
		var lastname=$("l_name");
		var email=$("email");
		var password=$("password");
		var dataString="f_name="+firstname+"l_name="+lastname+"&email="+email+"&password="+password+"&register=";
		if($.trim(fullname).length > 0 & $.trim(lastname).length > 0 & $.trim(email).length > 0 & $.trim(password).length > 0)
		{
			$.ajax({
				type: "POST",
				url: "register.php",
				data: dataString,
				crossDomain: true,
				cache: false,
				beforeSend: function(){ $("register").val('Submitting...');},
				success: function(data){
					if(data=="success")
					{
					alert("Your account has been registered");
					}
					else if(data="exist")
					{
					alert("You already have an account with us");
					}
					else if(data="failed")
					{
					alert("Something Went wrong");
					}
				}
			});
		}
		return false;
	}
}