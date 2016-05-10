$(document).ready(function() {

	function showPosts() {
		$.ajax({
			type: "POST",
			url: "TestPage.php",
			data: {action: showPosts},
			success: function(data) {
				$("#content").html(data);
			}
		})
	}

})