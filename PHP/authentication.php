<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 08.11.2017
 * Time: 17:01
 */
require_once "login.php";

/**
 * @return array|bool
 */

function authenticate() {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $data = checklogin($email, $password);
        $success = $data['success'];
        $userId = $data['userID'];
    }
    if ($success == true) {

        $result = ['authenticated' => true, 'userID' => $userId];
        return $result;
    } else if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } else {
        $result = array ('authenticated' => false);
        return $result;
    }
}