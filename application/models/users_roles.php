<?php
class Users_roles extends CI_Model {
    /**
     * User unifying record.
     * @var int
     */
    public $uid;
    /**
     * Role unifying record.
     * @var int
     */
    public $rid;

    /**
     * Get_roles_list
     * @return array of roles IDS Example array(0 => 2, 1 => 4)
     */
    public function get_roles_list () {
        $list = array();
        $this->db->select ('rid');
        $this->db->from ('users_roles');
        $this->db->where ('uid', $this->uid);

        $query = $this->db->get ();
        foreach ($query->result () as $key => $object) {
         $list[$key] = $object->rid;
        }
        return $list;
    }
    /**
     * Affect_user_to_role function.
     */
    public function affect_user_role () {
        $uid = $this->uid;
        $rid = $this->rid;
        $this->db->insert ('users_roles', array('uid' => $uid, 'rid' => $rid));
    }
}