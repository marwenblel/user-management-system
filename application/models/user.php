<?php
class User extends CI_Model {
    /**
     * User unique identifier.
     * @var int
     */
    private $uid;
    /**
     * User unique name
     * @var String
     */
    private $name;
    /**
     * User email.
     * @var String
     */
    private $mail;
    /**
     * User password
     * @var String
     */
    private $password;

    /** Getters and Setters **/
    public function set_uid ($uid) {
        $this->uid = $uid;
    }
    public function set_name ($name) {
        $this->name = $name;
    }
    public function set_mail ($mail) {
        $this->mail = $mail;
    }
    public function set_password ($password) {
        $this->password = $password;
    }
    public function get_uid () {
        return $this->uid;
    }
    public function get_name () {
        return $this->name;
    }
    public function get_mail () {
        return $this->mail;
    }
    public function get_password () {
        return $this->password;
    }
}