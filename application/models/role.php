<?php
class Role extends CI_Model {
    const DB_TABLE    = 'roles';
    const DB_TABLE_PK = 'rid';
    /**
     * Role unique identifier.
     * @var int
     */
    private $rid;
    /**
     * Role name.
     * @var String
     */
    private $name;

    /** Getters and Setters **/
    public function set_rid ($rid) {
        $this->rid = $rid;
    }
    public function set_name ($name) {
        $this->name = $name;
    }
    public function get_rid () {
        return $this->rid;
    }
    public function get_name () {
        return $this->name;
    }

}