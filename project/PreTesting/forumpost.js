$(document).ready(function()
{
	/* form validation rules */

	alert("document is ready");

	$("#forumpost").validate({

		rules:
		{
			ata: {
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
		 url: 'forumpost.php',
         data: data,
         type: "POST",
         success: function(output) {
                      alert(output);
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
