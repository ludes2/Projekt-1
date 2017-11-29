<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 31.10.2017
 * Time: 15:28
 */

include_once "validator.php";

class email_validator extends validator {

    private $email;

    function __construct($email) {
        $this->email = $email;
    }

    /**
     * removes illegal characters from the email address and
     * returns true if the email address is a valid expression, false otherwise
     * @return bool
     */
    public function isValid() {
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        return (!filter_var($this->email, FILTER_VALIDATE_EMAIL));
    }

}