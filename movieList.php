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
    <script src="variables.js"></script>
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
          echo ( "<h1>Welcome " . $_SESSION['UserName'] . "</h1>");
          echo( "<form method='post' action='./login.php'>");
          echo ("<button>Logout</button>");
          echo ("</form>");
          // echo ("<h1>" . ($_SESSION['userScales']->fetch_row() . "</h1>"));
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
  <script type="text/javascript">

console.log("about to see php?");
console.log( <?php //console log user scale objects to make sure they are recieved
  $scaleObj = json_encode($_SESSION['userScales']);
  echo($scaleObj);?>
);
var userScalesRaw = <?php //assign user scale objects from SQL to javascript variable
  $scaleObj = json_encode($_SESSION['userScales']);
  echo($scaleObj);?>;
var userScalesObject = userScalesRaw['Scales']; // extracts the scales object from the larger object. 
var userScales = JSON.parse(userScalesObject); //Parses to js object
var userMajorScaleArray = userScales['major'];
var userMinorScaleArray = userScales['minor'];
for (let n = 0; n < noteList.length; n++) {
    for (let r = 0; r < numberOfRows; r++) {
      // console.log(noteList[n]);
      // console.log(userMinorScaleArray[`${noteList[n]}`]);
      userMajorScaleArray[`${noteList[n]}`].push(" ");
    }
  }
  for (let n = 0; n < noteList.length; n++) {
    for (let r = 0; r < numberOfRows; r++) {
      // console.log(noteList[n]);
      // console.log(userMinorScaleArray[`${noteList[n]}`]);
      userMinorScaleArray[`${noteList[n]}`].push(" ");
    }
  }
console.log(userMinorScaleArray);
</script>
  <script src="final.js" defer>
  </script>

  <!-- <?php echo '<script type="text/javascript"> sessionStorage.setItem("userScales", "' . json_encode($_SESSION['userScales']) . '");</script>';?> -->
</body>
</html>