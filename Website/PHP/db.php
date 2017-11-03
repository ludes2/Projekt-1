<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 29.10.2017
 * Time: 14:51
 */

class db extends mysqli{
    const HOST="localhost", USER="root", PW="w1223", DB_NAME="projekt1";

    static private $instance;

    function __construct() {
        parent::__construct(self::HOST, self::USER, self::PW, self::DB_NAME);
    }

    /**4
     * @return mixed
     */
    public static function getInstance() {
        if (!self::$instance)
            @self::$instance = new DB();

        if(mysqli_connect_errno()){ //returns last error code for most recent function call
            die("unable to connect to Database: " . mysqli_connect_error()); //returns last error description for most resent function call
        }

        if(!self::$instance->set_charset("utf8")) {
            die("Error loading character set utf8: " . mysqli_connect_error());
        }
        return self::$instance;
    }


    public static function doQuery($sql) {
        return self::getInstance()->query($sql);
    }
}
