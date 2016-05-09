$('document').ready(function()
{
	$("#logout-btn").click(function()
	{
		localStorage.login="false";
		window.location.href = "index.html";
	});
});