<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 25.10.2017
 * Time: 13:03
 */

include_once "db.php";
include_once "Validators/email_validator.php";
include_once "Validators/password_validator.php";

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['sign-upPassword'], $_POST['confirmPassword'])){

    $error = false;
    /*declare variables for User input*/
    $email = $_POST['email'];
    $password = $_POST['sign-upPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];


    $email_validator = new email_validator($email);
    if($email_validator->isValid()){
       echo("your email address is invalid");
       $error = true;
    }

    $password_validator = new password_validator($password);
    if(!$password_validator->isValid()) {
        echo("your password doesn't match the rules");
        $error = true;
    }

    /*check if email is already registrated*/
    if (!$error) {
        $result = $db->query("SELECT * FROM projekt-1.users WHERE email = '$email';");
        $row = $result->fetch_assoc();
        $row_count = $result->num_rows;
        if ($row_count != 0) {
            $error = true;
            echo("this email is already in use");
        }
    }

    /*insert the data into the table*/
    if (!$error) {
        /*encrypt the password with the 'PASSWORD_DEFAULT? algorithm*/
        $encryptedPw = password_hash($password, PASSWORD_DEFAULT);
        /*prepare the sql query*/
        if (!($stmt = $db->prepare("INSERT INTO projekt-1.users (email, password, firstname, lastname)
        VALUES(?, ?, ?, ?)"))) {
            echo "prepare failed: (" . $db->errno . " )" . $db->error;
        }
        /*bind the parameters with the values*/
        if (!$stmt->bind_param("ssss", $email, $encryptedPw, $firstname, $lastname)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        /*execute the prepared statement*/
        if (!$stmt->execute()) {
            echo "Execution failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

}