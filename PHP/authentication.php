<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 08.11.2017
 * Time: 17:01
 */

include_once "login.php";

session_start();

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(checklogin($email, $password)) {
        $_SESSION['user'] = $email;
    }
}

if(!isset($_SESSION['user'])) {
    echo "please log in"; //can also link to the loginpage
    exit;
}