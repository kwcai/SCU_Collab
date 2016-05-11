$(document).ready(function() {


	function showgroups() {

		var user = localStorage.getItem('user');

		$.ajax({
			type: "POST",
			url: "group_display.php",
			data: {user: user},
			success: function(data) {
				$("#grouplist").html(data);
			}
		})
	}

	showgroups();

})