<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 02.11.2017
 * Time: 19:01
 */

class user {

    private $user_id, $email, $firstname, $lastname, $password_hash;


    function __construct() {

    }

    /**
     * @return mixed
     */
    public function getFirstName() {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash() {
        return $this->password_hash;
    }


    public function to_String() {
        return sprintf("%d, %s, %s, %s",
            $this->user_id, $this->firstname, $this->lastname, $this->email);
    }

    /**
     * @return array|null
     */
    public static function getUsers() {
        $users = array();
        $res = db::doQuery(
            "SELECT * FROM projekt1.users;"
        );
        if(!$res) return null;
        while($user = $res->fetch_object(get_class())) {
            $users[] = $user;
        }
        return $users;
    }

    /**
     * @param $id
     * @return null
     */
    public static function getUserById($id) {
        $id = (int) $id;
        $res = db::doQuery(
            "SELECT * FROM projekt1.users WHERE user_id = $id"
        );
        if(!$res) return null;
        return $res->fetch_object(get_class());
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id) {
        $id = (int) $id;
        $res = db::doQuery(
            "DELETE FROM projekt1.users WHERE user_id = $id"
        );
        return $res != null;
    }

    /**
     * @param $values
     * @return bool
     */
    public static function insert($values) {
        $stmt = db::getInstance()->prepare(
            "INSERT INTO projekt1.users " . "(email, firstname, lastname) " .
            "VALUE (?, ?, ?)"
        );
        if(!$stmt) return false;
        $success = $stmt->bind_param('sss',
            $values['email'],
            $values['firstname'],
            $values['lastname']
        );
        if(!$success) return false;
        return $stmt->execute();
    }



}