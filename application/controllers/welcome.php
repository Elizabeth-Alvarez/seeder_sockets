<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->output->enable_profiler();
		$this->load->model('User');
	}

	public function index() {
		$this->load->view('home');
	}

	public function users() {
		$arr = $this->User->get_users();
		// var_dump($arr);
		// die();
		echo json_encode($arr);
	}

	public function words() {
		$arr = $this->User->get_words();
		// var_dump($arr);
		// die();
		echo json_encode($arr);
	}

	public function blocked_words() {
		$arr = $this->User->get_blocked_words();
		// var_dump($arr);
		// die();
		echo json_encode($arr);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
