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
		<script src="final.js" defer></script>
	</head>
	<body>
    <header>
			<h1>Scale Tracker</h1>
			<div class= 
				<?php 
				if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']) {
					echo('displayNone') ;
        } else {
					echo('loginContainer');
				}?>
				>
				
					<h3>Log in to save progress</h3>
					<button class="loginButton"><a href="./login.php">Login</a></button>
				</div>

			
		</header>
		<h1 id='movieTitle'></h1>
		<?php
        if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == true) {
            echo ( "<h1>Welcome</h1>");
            echo( "<form method='post' action='./login.php'>");
            echo ("<button>Logout</button>");
            echo ("</form>");
        } else {
			echo ("<h1>Sorry not logged in</h1>");
		}
			
		?>
		<!--Used tablegenerator.com to make table. Reworked with javascript for easy addition of classes and onclicks -->
		<style type="text/css"> 
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr id='headRow'>
    <th class="tg-0pky"></th>
    <th class="tg-0lax">Ab</th>
    <th class="tg-0lax">A</th>
    <th class="tg-0lax ">Bb</th>
    <th class="tg-0lax">B</th>
    <th class="tg-0lax">C</th>
    <th class="tg-0lax">Db</th>
    <th class="tg-0lax">D</th>
    <th class="tg-0lax">Eb</th>
    <th class="tg-0lax">E</th>
    <th class="tg-0lax">F</th>
    <th class="tg-0lax">Gb</th>
    <th class="tg-0lax">G</th>
  </tr>
</thead>
<tbody id='scaleChartBody'>
</tbody>
</table>
	</body>
</html>