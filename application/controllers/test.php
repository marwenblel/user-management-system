<?php if (! defined('BASEPATH')) exit('No direct script access allowed!');
class Test extends CI_Controller {
    function __construct () {
        parent::__construct ();
    }
    public function index () {
        $this->load->model ('User');
        $user = new User();
        $user->load(2);
        print_r($user->get_roles_names());

    }
}