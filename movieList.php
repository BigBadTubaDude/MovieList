<?php include 'library.php'; ?>
<DOCTYPE html>
		<!--
		Coleman Alexander
		Date 11/30/2022
		-->
<html>
	<head>
		<title>Movie List</title>
		<link href="final.css" rel="stylesheet" type="text/css" />
		<script src="final.js" > </script>
	</head>
	<body>
    <header>
			<h1>Movies I want to watch: the website</h1>
			<button class="loginButton"><a href="./login.php">Login</a></button>
		</header>
		<h1 id='movieTitle'></h1>
		<?php
        if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == true) {
            echo ( "<h1>Welcome</h1>");
        } else {
			echo ("<h1>Sorry not logged in</h1>");
		}
			
		?>
	</body>
</html>