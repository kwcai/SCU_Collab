<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="homepagetest.css">
	</head>
	<body>
		<div id="headerbar">
			<h1 class="center">SCU Collab</h1>
		</div>
		
		<div id="footerbar">
			<h2 class="center">Welcome, <em><?php echo $current_user;?>!</em></h2>
		</div>
		
		<img class="toggle" src="toggle_sidebar.png" onclick="toggle_sidebar()">

		<div id="sidebar">
			<ul>
				<li><?php echo $current_user;?></li>
				<li><h2>Math group</h2></li>
				<li id="logout"><h3>Logout</h3></li>
			</ul>
		</div>
	</body>
	
	
	
	<script>
        function toggle_sidebar()
        {
            var sidebar = document.getElementById("sidebar");
            
            console.log(sidebar.style.left);
            
            if(sidebar.style.left == "-200px")
            {
                sidebar.style.left = "0px";
			}
            else
            {
                sidebar.style.left = "-200px";
			}
		}
	</script>
</html>