<?php
class Role extends My_Model {
    const DB_TABLE    = 'roles';
    const DB_TABLE_PK = 'rid';
    /**
     * Role unique identifier.
     * @var int
     */
    public $rid;
    /**
     * Role name.
     * @var String
     */
    public $name;

}