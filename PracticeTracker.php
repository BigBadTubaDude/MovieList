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
    <script src="variables.js"></script>
	</head>
	<body>
    <header>
      <h1>Scale Tracker</h1>
		</header>
		<?php
        $conn = new mysqli("localhost", "root", "", "users");
        if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == true) {
          echo ( "<h1>Welcome " . $_SESSION['UserName'] . "</h1>");
          /////Logout button
          echo( "<form method='POST' action='./login.php'>");
          echo ("<button>Logout</button>");
          echo ("</form>");
          /////Save Button
          echo ("<form method='POST' action='$_SERVER[PHP_SELF]'>");
          echo ("<button name='scaleObject' onclick='() => stringifySaveData($_SESSION['userScales'])' id='saveButton'>Save Progress</button>");
          echo ("</form>");

        } else {
          echo ("<h1>Sorry not logged in</h1>");
          echo ("<h3>Log in to save progress</h3>");
          echo ("<button class='loginButton'><a href='./login.php'>Login</a></button>");
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
          getUserChartFromSQL();
        }
        echo 
        <script type='text/css'></script>;
      
        
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
    <h1><?php echo '$_SESSION[UserName]' ?></h1>
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
      // userScales['major'][noteList[n - 1]][r] = ("x");
    }
  }
  for (let n = 0; n < noteList.length; n++) {
    for (let r = 0; r < numberOfRows; r++) {
      // console.log(noteList[n]);
      // console.log(userMinorScaleArray[`${noteList[n]}`]);
      // userMinorScaleArray[`${noteList[n]}`] = (" ");
    }
  }
// console.log('frfr');

</script>
<script src="final.js" defer>
  stringifySaveData(<?php$_SESSION['userScales']?>);
  </script>
</body>
</html>