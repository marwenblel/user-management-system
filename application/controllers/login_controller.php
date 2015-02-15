<?php if (! defined('BASEPATH')) exit('No direct script access allowed!');
define('ADMINISTRATOR', 'administrator');
define('AUTHENTICATED_USER', 'authenticated user');
session_start();
class Login_Controller extends CI_Controller {
    /**
     * Constructor for Login_Controller controller.
     */
    function __construct () {
        parent::__construct ();
        // Load form Helper.
        $this->load->helper (array('form'));
    }

    /**
     * Index function for Login_Controller controller.
     */
    public function index () {
        // Test user is logged in.
        if ($this->session->userdata('logged_in')) {
            $user_session = $this->session->userdata('logged_in');
            // Test access by roles.
            if (in_array(ADMINISTRATOR, $user_session['roles'])) {
                $this->load->view ('templates/header', $user_session);
                $this->load->view ('admin/home_view', $user_session);
            } elseif (in_array(AUTHENTICATED_USER, $user_session['roles'])) {
                $this->load->view ('home_view', $user_session);
            }
        } else {
            // Load view `login_view`.
            $this->load->view ('login_view');
        }
    }
    /**
     * Check login function.
     */
    public function check_login () {
        // Load library `form_validation`.
        $this->load->library ('form_validation');
        // Set validation rules.
        $this->form_validation->set_rules ('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules ('password', 'Password', 'required|trim|xss_clean|callback_check_authentication');

        if (!$this->form_validation->run()) {
            $this->load->view ('login_view');
        } else {
            $user_session = $this->session->userdata('logged_in');
            // Test access by roles.
            if (in_array(ADMINISTRATOR, $user_session['roles'])) {
                //$this->load->view ('admin/home_view', $user_session);
                redirect('login_controller');
            } elseif (in_array(AUTHENTICATED_USER, $user_session['roles'])) {
                //$this->load->view ('home_view', $user_session);
                redirect('login_controller');
            } else {
                $this->logout();
                $this->load->view (login_view);
            }

        }
    }

    /**
     * Check User authentication.
     * @param String $password
     * @return boolean
     */
    public function check_authentication ($password) {
        $username = $this->input->post ('username');
        // Load User Model.
        $this->load->model ('user');
        $user = new User();
        $user->name     = $username;
        $user->password = $password;

        if ($user->connect()) {
            $user = $user->connect();

            // Create a user session
            $user_session = array(
              'user_id'   => $user->uid,
              'user_name' => $user->name,
              'roles'     => $user->get_roles_names (),
            );

            $this->session->set_userdata ('logged_in', $user_session);
            $ret_value = TRUE;
        } else {
            $this->form_validation->set_message ('check_authentication', 'Invalid username and password!');
            $ret_value = FALSE;
        }
        return $ret_value;
    }

    /**
     * Logout function.
     */
    public function logout () {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login_controller');
    }


}