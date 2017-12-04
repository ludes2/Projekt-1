<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 31.10.2017
 * Time: 16:12
 */

include_once "validator.php";

class password_validator extends validator {

    private $password;
    /*password must be at least 6 characters and must contain at least one number*/
    const regex = '/(?=\S{6,})(?=\S*[\d])/';

    function __construct($password) {
        $this->password = $password;
    }

    /**preg_match returns 1 if the pattern matches given subject, 0 if it does not, or FALSE if an error occurred.
     * @return bool
     */
    public function isValid() {
        return preg_match(self::regex, $this->password) === 1;
    }
}