$(document).ready(function() {

	alert("Document is ready");

	function showPosts() {
		$.ajax({
			//type: "POST",
			url: "groups/TestPage.php",
			data: "function=posts",
			success: function(data) {
				$("#content").html(data);
			}
		})
	}

	showPosts();

})