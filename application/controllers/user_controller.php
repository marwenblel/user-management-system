<?php if (! defined('BASEPATH')) exit('No direct script access allowed!');
define('ADMINISTRATOR', 'administrator');
define('AUTHENTICATED_USER', 'authenticated user');
session_start();
class User_controller extends CI_Controller {
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
                $this->load->view ('admin/add_user_view', $user_session);
            } elseif (in_array(AUTHENTICATED_USER, $user_session['roles'])) {
                $this->load->view ('home_view', $user_session);
            }
        } else {
            // Load view `login_view`.
            $this->load->view ('login_view');
        }
    }
    public function list_users () {
        // Load table library
        $this->load->library ('table');
        // Load model User
        $this->load->model ('User');
        $users_list = array();
        $users = $this->User->get ();
        foreach ($users as $user) {
           $users_list [] = array(
               $user->name,
               $user->mail,
           );
        }
        $user_session = $this->session->userdata('logged_in');
        $this->load->view ('templates/header', $user_session);
        $this->load->view ('admin/users_list', array(
            'users_list' => $users_list,
        ));
    }
    public function get_user_account ($uid) {
        // Load model User
        $this->load->model ('User');
        $user = new User();
        $user->load($uid);
        $user_session = $this->session->userdata('logged_in');
        $this->load->view ('templates/header', $user_session);
        $this->load->view ('admin/user_view', (array) $user);
    }
    public function add_user () {
        // Load form_validation library
        $this->load->library ('form_validation');
        // Set validation rules
        $this->form_validation->set_rules ('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules ('email', 'Email', 'required|trim|xss_clean');
        $this->form_validation->set_rules ('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules ('password_confirm', 'Confirm password', 'required|trim|xss_clean|callback_password_confirm');
        if (!$this->form_validation->run ()) {
            // refresh user controller
            $this->load->view ('admin/add_user_view');
        } else {
            // Load User model
            $this->load->model ('User');
            $user = new User();
            $user->name = $this->input->post ('username');
            $user->mail = $this->input->post ('email');
            $user->password = MD5 ($this->input->post ('password'));
            $user->save();
            $this->load->view ('admin/add_user_view');
        }

    }

    /**
     * Confim password for user_controller.
     * @param String $password_confirm
     * @return boolean
     */
    public function password_confirm ($password_confirm) {
       if ($this->input->post ('password') == $password_confirm) {
           return TRUE;
       } else {
           $this->form_validation->set_message ('password_confirm', 'Password not identical!');
           return FALSE;
       }
    }
}