<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 08.11.2017
 * Time: 17:01
 */

include_once "login.php";
include_once "../controllers/duration_controller.php";
include_once "../PHP/db.php";

session_start();

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];



    if(checklogin($email, $password)) {
        $_SESSION['userMail'] = $email;
       header('location: http://localhost:63342/Projekt-1/views/home.php');
   }
}




$duration = new duration();

$d_controller = new duration_controller($duration);

global $json;



if (isset($_POST['jsonDuration'])) {
    $json = $_POST['jsonDuration'];
}

$d_controller->saveDurationInDB($json); //var_dump geht nicht in if statement

//if(!isset($_SESSION['userMail'])) {
//    echo "please log in"; //can also link to the loginpage
//    exit;
//}