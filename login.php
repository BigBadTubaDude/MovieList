<?php include 'library.php'; ?>
<DOCTYPE html>
		<!--
		Coleman Alexander
		Date 11/30/2022
		-->
<html>
	<head>
		<title>Title</title>
		<link href="final.css" rel="stylesheet" type="text/css" />
		<script src="final.js" > </script>
	</head>
	<body>
		<header>
			<h1>Movies I want to watch: the website</h1>
			<h2>Log in</h2>
		</header>

		
		<?php
			// Adds username, password, json of movie list (incremental movie number: movie name), review list (movie name: review string), review rating (movie name: 1-10), date joined)
			
			$conn = new mysqli("localhost", "root", "", "test");			
			$maxAttempts = 7;
			$checkIfUserExistsQuery = 
				(<<<HERE
					SELECT * FROM users 
					WHERE 
					userName='$_POST[userName]';		
				HERE);
			printLoginForm();
			
			
			if (isset($_POST['radLogin'])) {
				
				//If user selected "Login"
				if ($_POST['radLogin'] == 'login') {
					if (isset($_POST['userName']) 
						&& validateUserNameInput($_POST['userName']) 
						&& isset($_POST['password']) 
						&& validatePasswordInput($_POST['password']))
					{
					}
					//USE query to check user and pass
					if (false) {
						
					}
				}
				
				//If user selected New User
				if ($_POST['radLogin'] == 'newUser') {
					//Tests if user and pass are set and not empty (uses short circuting to only test for empty string if each has been set)
					if (isset($_POST['userName']) 
						&& validateUserNameInput($_POST['userName']) 
						&& isset($_POST['password']) 
						&& validatePasswordInput($_POST['password'])){		
							$result = mysqli_query($conn, $checkIfUserExistsQuery) or die ("fatal error: " . mysqli_error($mysql));				
							if ($result->num_rows < 1) {
								$addNewUserQuery = (<<<HERE
									INSERT INTO users 
									values (
										'$_POST[userName]',
										'$_POST[password]',
										'{}', 
										'{}',
										'{}',
										curdate()
									);
									HERE);
									$result = mysqli_query($conn, $addNewUserQuery) or die ("fatal error: " . mysqli_error($mysql));
							} else {
								print ("That user already exists. Please log in.");
							}
					} else {

					}
				}

				//If "back" is selected, takes user back to main page without logging in
				if ($_POST['radLogin'] == 'back') {
					header("Location: /movielist/movieList.php");

				}
				
			}
			// print;
		?>
	</body>
</html>