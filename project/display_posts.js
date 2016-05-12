$(document).ready(function() {


	function showPosts() {

		var user = localStorage.getItem('user');

		$.ajax({
			type: "POST",
			url: "display_posts.php",
			data: {user: user},
			success: function(data) {
				$("#recentposts").html(data);
			}
		})
	}

	showPosts();

})