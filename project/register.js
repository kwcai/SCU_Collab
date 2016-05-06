$(document).ready(function()
{
	/* form validation rules */

	$("#reg").validate({
		
		rules:
		{
			f_name: {
				required: true
			},
			l_name: {
				required: true
			},
			password: {
				required: true
			},
			/*
			password_check: {
				required: true,
				equalTo: '#password'
			}
			*/
			email: {
				required: true
				//,email: true
			}
		},

		messages:
		{
			f_name: "Please enter your first name",
			l_name: "Please enter your last name",
			password: "Please enter a password",
			email: "Please enter an email",
		},

		submitHandler: submitForm

	})


	/* form submission */

	function submitForm()
	{

		var data = $("#reg").serialize();

		$.ajax({

			type: "POST",
			url: "register.php",
			data: data,
			success : function(data)
			{
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
		})
		return false;
	}
});	