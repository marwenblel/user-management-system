<?php
class User extends My_Model {
    const DB_TABLE    = 'users';
    const DB_TABLE_PK = 'uid';
    /**
     * User unique identifier.
     * @var int
     */
    public $uid;
    /**
     * User unique name
     * @var String
     */
    public $name;
    /**
     * User email.
     * @var String
     */
    public $mail;
    /**
     * User password
     * @var String
     */
    public $password;

    /**
     * Load from the database.
     */
    public function load_by_name () {
        $query = $this->db->get_where($this::DB_TABLE, array(
            'name' => $this->name,
        ));
        $this->populate($query->row());
    }

    /**
     * Load from the database.
     */
    public function load_by_name_password () {
        $query = $this->db->get_where($this::DB_TABLE, array(
            'name'     => $this->name,
            'password' => MD5($this->password),
        ));
        $this->populate($query->row());
    }
    /**
     * connect method must return FALSE or
     * Connect function: Test user credentials login and password from database.
     * @return boolean
     */
    public function connect () {
        $this->load_by_name_password();
        if ($this->uid == NULL) {
            return FALSE;
        } else {
            return $this;
        }

    }

    /**
     * Get_roles_names function.
     * @return array of roles names; Example array(0 => 'administrator', 1 => 'authenticated user')
     */
    public function get_roles_names () {
        // Load Users_roles Model.
        $this->load->model ('Users_roles');
        $users_roles = new Users_roles();
        $users_roles->uid = $this->uid;
        $roles_list = $users_roles->get_roles_list();

        $names_list = array();
        // Load Roles Model.
        $this->load->model ('Role');
        foreach ($roles_list as $key => $rid) {
            $role = new Role();
            $role->load($rid);
            $names_list[$key] = $role->name;
        }
        return $names_list;
    }

    /**
     * User is administrator or not.
     * @return boolean
     */
    public function is_administrator () {
        if (in_array('administrator', $this->get_roles_names())) {
          return TRUE;
        } else {
            return FALSE;
        }
    }

}




