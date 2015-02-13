<?php if (! defined('BASEPATH')) exit('No direct script access allowed!');
define('USERNAME', 'admin');
define('PASSWORD', 'admin');
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
      // Load view `login_view`.
      $this->load->view ('login_view');
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
            redirect('login_controller', 'refresh');
        } else {
            $user_session = $this->session->userdata('logged_in');
            $this->load->view ('home_view', $user_session);
        }
    }
    public function check_authentication ($password) {
        $username = $this->input->post ('username');
        // Load User Model.
        $this->load->model ('user');
        $user = new User();
        $user->set_name($username);
        $user->set_password($password);
        if ($user->connect()) {
            // Create a user session
            $user_session = array();
            foreach ($user->connect() as $row) {
                $user_session = array(
                    'user_id'   => $row->uid,
                    'user_name' => $row->name,
                );
            }
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
        redirect('login_controller', 'refresh');
    }


}