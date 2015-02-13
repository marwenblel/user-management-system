<?php if (! defined('BASEPATH')) exit('No direct script access allowed.');
class Test extends CI_Controller {
    /**
     * Constructor for Test controller.
     */
    function __construct () {
        parent::__construct();
    }
    /**
     * Index function for Test controller.
     */
    public function index () {
       $this->load->model('User');
       $user = new User();
       $user->set_uid(1);
       $user->set_name('user1');
       $user->set_mail('user1@gmail.com');
       $user->set_password('123ABC**');
       print_r($user);
    }
}