$(document).ready(function()
{
	/* form validation rules */

	//alert("document is ready");

	$("#new-group").validate({

		rules:
		{
			g_name: {
				required: true
			},
			password: {
				required: true
			},
		},

		messages:
		{
			g_name: "Please enter a group name",
			password: "Please enter a password",
		},

		submitHandler: newGroupPage

	})

	function newGroupPage(){

		//alert("Function called");

		var data = $("#new-group").serialize();
		var user = localStorage.getItem('user');
    	var data = data + "&user=" + user;
    	//var link = $('#g_name').val();
    	//link = str.replace(/\s/g, '');
    
   	 	//alert(data);
   	 	//alert(link);

		$.ajax({ 
		 url: 'newGroupPage.php',
         data: data,
         type: "POST",
         success: function(output) {
                      //alert(output);
                      if(output == "This Group Name has already been taken")
                      {
                      	alert(output);
                      }
                      else {
                      	//alert(location.href)
                      window.location.replace("/~kcai/SCU_Collab/groups/"+output);
                  	  }
                  }
		});
	}
})
