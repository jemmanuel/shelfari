<?php


class Library extends CI_Controller {

	public function index(){

		$this->load->helper('url');
		// View for this function is defined in views/library/index.php
		$this->load->view('library/index');

	}

}

/* End of file library.php */
/* Location: ./application/controllers/library.php */