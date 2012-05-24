<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {
	
	public function index()
	{
		$this->load->view('connect');
	}
	
	public function signin()
	{

		$credentials = array(

      'consumer_key' => $this->config->item('oauth_consumer_key'),
      'consumer_secret' => $this->config->item('oauth_consumer_secret')

    );

		$this->load->library('twitter', $credentials);

    if (is_object($req = $this->twitter->authenticate())) {

    }
		
	}
	
	public function callback()
	{
		
		print_r($_POST);

		print_r($_GET);

	}
	
}