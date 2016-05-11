$(document).ready(function()
{
	/* form validation rules */

	alert("document is ready");

	$("#forumpost").validate({

		rules:
		{
			data: {
				required: true
			},
		},

		messages:
		{
			data: "Your post cannot be empty",
		},

		submitHandler: newPost

	})

	function newPost(){

		var data = $("#forumpost").serialize();
		var user = localStorage.getItem('user');
    	var data = data + "&user=" + user;
    
    	alert(data);

		$.ajax({ 
		 url: '{group_link}post.php',
         data: data,
         type: "POST",
         success: function(output) {
                      alert(output);
                  }
		});
	}
})