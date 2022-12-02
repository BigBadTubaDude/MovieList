<?php

// start or continue the session_cache_expire
session_start();
// $_SESSION['LoggedIn'];
/*
Coleman Alexander
Date 11/30/2022
*/
/*
******************************************

Function library: filename-library.php
functions:
    printLoginForm()
    validateUserNameInput(username string)
    validatePasswordInput(password string) 
    getScales($userName,$password) 
    instructionsBlock()

    
******************************************
have file to run to create table of users?
*/
$_SESSION['emptyChart'] = 
        <<<END
        {"major" : 
        {"Ab": [" "," "," "," "," "," ", " "," "," "," "," "," "],
        "A":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "Bb":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "B":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "C":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "Db":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "D":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "Eb":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "E":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "F":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "Gb":[" "," "," "," "," "," ", " "," "," "," "," "," "],
        "G":[" "," "," "," "," "," ", " "," "," "," "," "," "]}
        };
        END;
function printLoginForm() {
    echo (<<<HERE
        <form method='post' action="./login.php" class="loginForm">
            <lable for='userName'>Username</lable>
            <input type='text' name='userName'/>
            <lable for='password'>Password</lable>
            <input type='password' name='password'/>
            </br>
            <lable for='Login' >Login</lable>
            <input type='radio' name='radLogin' value='login' checked/>
            <lable for='newUser'>New User</lable>
            <input type='radio' name='radLogin' value='newUser'/>
            <lable for='back'>Back</lable>
            <input type='radio' name='radLogin' value='back'/>
            </br>
            <button type='submit' value ='submit'>Submit</button>
        </form>
        HERE);
}
function validateUserNameInput($username) {
    if (strlen($username) == 0) {
        print "<p class='error'>Username cannot be empty</p>";
        return false;
    } else return true;
}
function validatePasswordInput($password) {
    if (strlen($password) == 0) {
        print "<p class='error'>Password cannot be empty</p>";
        return false;
    } else return true;
}  
function getScales($userName,$password) {
    $conn = new mysqli("localhost", "root", "", "users");	
    $getUserScales = <<<HERE
    SELECT Scales FROM userinfo 
    WHERE 
    userName='$userName' AND
    password='$password';		
    HERE;
    $_SESSION['userScales'] = mysqli_query($conn, $getUserScales)->fetch_object() or die ("fatal error: " . mysqli_error($mysql));
  }
function instructionsBlock() {
    echo <<<HERE
    <div id='instructions'>
        <h1 id='instructionsH'></h1>
        <p id='instructionsP'></p>
    </div>
    <div id='whyScales'>
        <h2 id='whyH'></h2>
        <p id='whyP'></p>
    </div>
    HERE;
}
?>
