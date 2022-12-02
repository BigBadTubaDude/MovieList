<?php include 'library.php'; ?>
<DOCTYPE html>
		<!--
		Coleman Alexander
		Date 11/30/2022
		-->
<html>
	<head>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
		<title>Title</title>
		<link href="final.css" rel="stylesheet" type="text/css" />
		<script src="instructions.js"></script>
		<script src="final.js" > </script>
	</head>
	<body>
		<section class='appContainerLogin'>
			<header>
				<h1>Scale Tracker</h1>
				<h2>Log in</h2>
			</header>

			
			<?php
				
				//If user navigates to this page, they are logged out (only option when logged in will be log out button)
				$_SESSION['LoggedIn'] = false;


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
							$checkIfUserPassMatchQuery = <<<HERE
								SELECT * FROM userinfo 
								WHERE 
								userName='$_POST[userName]' AND
								password='$retrievedHashedPassword';		
								HERE;
							$userPassMatch = mysqli_query($conn, $checkIfUserPassMatchQuery) or die ("fatal error: " . mysqli_error($mysql));
							$row = $userPassMatch->fetch_assoc();
							//USE query to check user and pass
							if ($userPassMatch->num_rows < 1) {
								echo ("Incorrect username or password. Try again.");
							} 
							else { //Correct user/pass								
								$_SESSION['LoggedIn'] = true;
								$_SESSION['UserName'] = $row['userName'];
								$_SESSION['UserMajor'] = '{}';
								$_SESSION['UserMinor'] = '{}';
								$_SESSION['password'] = $_POST['password'];
								getScales($_SESSION['UserName'], md5($_SESSION['password'], false));
								//Logs user in and directs them to main page
								header("Location: /FinalCA/PracticeTracker.php");
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
								if ($result->num_rows < 1) { //a correct user/pass combo exists
									$hashedPassword = md5($_POST['password'], false); //hash inputted password to compare to database
									$scalesJSON = json_encode("{'major':[], 'minor':[]}");
									$addNewUserQuery = (<<<HERE
										INSERT INTO userinfo 
										(userName, password, Scales)
										values (
											'$_POST[userName]',
											'$hashedPassword',
											'{
												"major":{
													"Ab": [],
													"A": [],
													"Bb": [],
													"B": [],
													"C": [],
													"Db": [],
													"D": [],
													"Eb": [],
													"E": [],
													"F": [],
													"Gb": [],
													"G": []	
												},											
												"minor":{
													"Ab": [],
													"A": [],
													"Bb": [],
													"B": [],
													"C": [],
													"Db": [],
													"D": [],
													"Eb": [],
													"E": [],
													"F": [],
													"Gb": [],
													"G": []
												}}'
										);
										HERE);
										$result = mysqli_query($conn, $addNewUserQuery) or die ("fatal error: " . mysqli_error($mysql));

										echo ("Thank you for creating an account.</br> Please log in.");
								} else {
									print ("That user already exists. Please log in.");
								}
						}
					}

					//If "back" is selected, takes user back to main page without logging in
					if ($_POST['radLogin'] == 'back') {
						header("Location: /FinalCA/PracticeTracker.php");
					}
				}
				// print;
				// instructionsBlock();
			?>
		</section>
	</body>
</html>