<?php if (! defined('BASEPATH')) exit('No direct script access allowed!');
define('USERNAME', 'admin');
define('PASSWORD', 'admin');
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
          $this->load->view ('login_view');
        } else {
          $this->load->view ('home_view');
        }
    }
    public function check_authentication ($password) {
        $username = $this->input->post ('username');
        if ($username == USERNAME AND $password == PASSWORD) {
            $ret_value = TRUE;
        } else {
            $this->form_validation->set_message ('check_authentication', 'Invalid username and password!');
            $ret_value = FALSE;
        }
        return $ret_value;
    }

}