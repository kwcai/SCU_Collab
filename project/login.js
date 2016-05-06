$('document').ready(function()
{
	/* form validation */
	$("#login-form").validate({
		
		rules:
		{
			password: {
				required: true
			},
			email: {
				required: true
			},
		},

		message:
		{
			password: "Enter your password",
			email: "Enter your password",
		},

		submitHandler: submitForm

	});

	/* submit login form */
	function submitForm()
	{
		var data = $("#login-form").serialize();

		$.ajax({

			type: "POST",
			url: "index.php",
			data: data,
			success : function(data)
			{

				if(data=="success")
				{
					localStorage.login="true";
					localStorage.email=$("#email").val();
					window.location.href = "home.php";
					alert("You are now logged in");
				}
				else if(data=="failure")
				{
					alert("Incorrect username or password");
				}
			}
		})
		return false;
	}


});