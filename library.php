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
    validateUserNameInput(username string) returns bool
    validatePasswordInput(password string) returns bool

    
******************************************
have file to run to create table of users?
*/
function printLoginForm() {
    echo (<<<HERE
        <form method='post' action="./login.php">
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


?>
