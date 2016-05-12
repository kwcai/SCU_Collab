$(document).ready(function()
{
	/* form validation rules */

	//alert("document is ready");

	$("#join-group").validate({

		rules:
		{
			g_name: {
				required: true
			},
			grouppassword: {
				required: true
			},
		},

		messages:
		{
			g_name: "Please enter a group name",
			grouppassword: "Please enter a password",
		},

		submitHandler: joinGroup

	})

	function joinGroup(){

		//alert("Function called");

		var data = $("#join-group").serialize();
		var user = localStorage.getItem('user');
    	var data = data + "&user=" + user;
    	//var link = $('#g_name').val();
    	//link = str.replace(/\s/g, '');
    
   	 	alert(data);
   	 	//alert(link);

		$.ajax({ 
		 url: 'join_group.php',
         data: data,
         type: "POST",
         success: function(output) {
                      //alert(output);
                      if(output == "You are already in this group" || output == "This group does not exist")
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
