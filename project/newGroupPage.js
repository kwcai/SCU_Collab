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

		alert("Function called");

		var data = $("#new-group").serialize();
		var user = localStorage.getItem('user');
    	var data = data + "&user=" + user;
    	//var link = $('#g_name').val();
    	//link = str.replace(/\s/g, '');
    
   	 	alert(data);
   	 	//alert(link);

		$.ajax({ 
		 url: 'newGroupPage.php',
         data: data,
         type: "POST",
         success: function(output) {
                      alert(output);
                      if(output == "This group name has already been taken")
                      {
                      	alert(output);
                      }
                      else {
                      	//alert(location.href)
                      window.location.replace("students.engr.scu.edu/~kcai/SCU_Collab/groups/"+output);
                  	  }
                  }
		});
    /*var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState==4 && xmlhttp.status==200)
        alert("webpage " + xmlhttp.responseText + " was successfully created!");
    }
    //var content = "<html><head><meta charset=\"utf-8\" /> </head><body>new website<script>alert(\"test\")</script></body></html>";
    xmlhttp.open("GET","newGroupPage.php", true);
    xmlhttp.send();*/
	}
})
