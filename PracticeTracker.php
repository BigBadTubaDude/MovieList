<?php include 'library.php'; ?>

<DOCTYPE html>
		<!--
		Coleman Alexander
		Date 11/30/2022
		-->
<html>
	<head>
		<title>Scale Tracker</title>

		<link href="final.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <script src="variables.js"></script>
    <script src="instructions.js"></script>
	</head>
	<body>
    <section class='appContainer'>
        <?php
          $conn = new mysqli("localhost", "root", "", "users");	
          if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == true) {
            echo ("<header>");
            echo ( "<h1>Scale Tracker</h1>");
            echo ( "<h2>Welcome " . $_SESSION['UserName'] . "</h2>");
            echo ( "</header>");
            /////Logout button
            echo( "<form method='POST' action='./login.php' class='logout'>");
            echo ("<button>Logout</button>");
            echo ("</form>");
            /////Save Button
            echo ("<form method='POST' action='$_SERVER[PHP_SELF]' class='saveButton'>");
            echo ("<button name='scaleObject' id='saveButton'>Save Progress</button>");
            echo ("</form>");
            
          } else {
            echo ("<header>");
            echo ("<h1>Sorry not logged in</h1>");
            echo ("<h3 class='loginInstructions'>Log in to save progress</h3>");
            echo ("</header>");
            echo ("<button class='logout'><a href='./login.php'>Login</a></button>");
          }
          //If the save button has been pressed
          if (isset($_POST['scaleObject'])) {
            
            $encodedScaleObject = json_encode($_POST['scaleObject']);
            $updateSaveDataQuery = <<<HERE
            UPDATE userinfo
            SET Scales = $encodedScaleObject
            WHERE userName = '$_SESSION[UserName]';
            HERE;
            mysqli_query($conn, $updateSaveDataQuery) or die ("fatal error: " . mysqli_error($mysql));
          }
          getScales($_SESSION['UserName'], md5($_SESSION['password'], false));
          instructionsBlock();
          ?>
      <!--Used tablegenerator.com to make table. Reworked with javascript for easy addition of classes and onclicks -->
      <style type="text/css"> 
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
      .tg .tg-0pky{border-color:inherit;}
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
  // console.log(userMinorScaleArray);
  </script>
</section>
<script type='text/javascript' src="final.js" defer>
  // makeScaleChart(currentScaleType);
  stringifySaveData();
  </script>
</body>
</html>