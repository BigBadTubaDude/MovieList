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
			
			//If user navigates to this page, they are logged out (only option when logged in will be log out button)
			$_SESSION['LoggedIn'] = false;

			// Adds username, password, json of movie list (incremental movie number: movie name), review list (movie name: review string), review rating (movie name: 1-10), date joined)

			$conn = new mysqli("localhost", "root", "", "users");			
			$maxAttempts = 7;
			printLoginForm();
			
			//If a user has selected and submitted form
			if (isset($_POST['radLogin'])) {
				
				//If user selected "Login"
				if ($_POST['radLogin'] == 'login') {
					if (isset($_POST['userName']) 
					&& validateUserNameInput($_POST['userName']) 
					&& isset($_POST['password']) 
					&& validatePasswordInput($_POST['password'])){
						$retrievedHashedPassword = md5($_POST['password'], false);
					 	$checkIfUserPassMatchQuery = 
							(<<<HERE
								SELECT * FROM userinfo 
								WHERE 
								userName='$_POST[userName]' AND
								password='$retrievedHashedPassword';		
							HERE);
						$userPassMatch = mysqli_query($conn, $checkIfUserPassMatchQuery) or die ("fatal error: " . mysqli_error($mysql));
						//USE query to check user and pass
						if ($userPassMatch->num_rows < 1) {
							echo ("Incorrect username or password. Try again.");
						} else { //Correct user/pass
							//Logs user in and directs them to main page
							$_SESSION['LoggedIn'] = true;
							header("Location: /movielist/movieList.php");

						}

				}
			}
				
				//If user selected New User
				if ($_POST['radLogin'] == 'newUser') {
					//Tests if user and pass are set and not empty (uses short circuting to only test for empty string if each has been set)
					if (isset($_POST['userName']) 
						&& validateUserNameInput($_POST['userName']) 
						&& isset($_POST['password']) 
						&& validatePasswordInput($_POST['password'])){		
							$checkIfUserExistsQuery = 
								(<<<HERE
									SELECT * FROM userinfo 
									WHERE 
									userName='$_POST[userName]';		
								HERE);
							$result = mysqli_query($conn, $checkIfUserExistsQuery) or die ("fatal error: " . mysqli_error($mysql));				
							if ($result->num_rows < 1) {
								$hashedPassword = md5($_POST['password'], false);
								$addNewUserQuery = (<<<HERE
									INSERT INTO userinfo 
									(userName, password, reviewStars, reviewParagraph, movieList)
									values (
										'$_POST[userName]',
										'$hashedPassword',
										'{}', 
										'{}',
										'{}'
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