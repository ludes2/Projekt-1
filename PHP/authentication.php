<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 08.11.2017
 * Time: 17:01
 */
require_once "login.php";

/**
 * this function checks the session status and starts a session if none is already started. it calls the "checklogin" function
 * with the POST-parameters 'email' and 'password'.
 * it returns an array with true or false and the userID if true.
 * @return array|bool
 */

function authenticate() {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $data = checklogin($email, $password);
        $success = $data['success'];
        $userID = $data['userID'];

    }

    if ($success == true) {
        $result = ['authenticated' => true, 'userID' => $userID];
        return $result;
    } else {
        $result = array ('authenticated' => false);
        return $result;
    }

}

