<?php if (! defined('BASEPATH')) exit('No direct script access allowed!');
define('ADMINISTRATOR', 'administrator');
define('AUTHENTICATED_USER', 'authenticated user');
session_start();
class Role_controller extends CI_Controller {
    function __construct () {
        parent::__construct ();
        $this->load->helper (array('form'));
    }
    public function index () {
        // Test user is logged in.
        if ($this->session->userdata('logged_in')) {
            $user_session = $this->session->userdata('logged_in');

            // Test access by roles.
            if (in_array(ADMINISTRATOR, $user_session['roles'])) {
                $this->load->view ('templates/header', $user_session);
                $this->load->view ('admin/add_role_view', $user_session);
            } elseif (in_array(AUTHENTICATED_USER, $user_session['roles'])) {
                $this->load->view ('home_view', $user_session);
            }
        } else {
            // Load view `login_view`.
            $this->load->view ('login_view');
        }
    }
    public function list_roles () {
        // Load table library
        $this->load->library ('table');
        // Load model User
        $this->load->model ('Role');
        $roles_list = array();
        $roles = $this->Role->get ();
        foreach ($roles as $role) {
            $roles_list [] = array(
                $role->name,
            );
        }
        $user_session = $this->session->userdata('logged_in');
        $this->load->view ('templates/header', $user_session);
        $this->load->view ('admin/roles_list', array(
            'roles_list' => $roles_list,
        ));
    }
    public function add_role () {
        // Load form_validation library
        $this->load->library ('form_validation');
        // Set validation rules
        $this->form_validation->set_rules ('rolename', 'Role name', 'required|trim|xss_clean');
        if (!$this->form_validation->run ()) {
            // refresh user controller
            $this->load->view ('admin/add_role_view');
        } else {
            // Load User model
            $this->load->model ('Role');
            $role = new Role();
            $role->name = $this->input->post ('rolename');
            $role->save();
            $this->load->view ('admin/add_role_view');
        }

    }
}