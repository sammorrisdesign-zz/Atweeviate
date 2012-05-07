<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {
	
	public function index()
	{
		$this->load->view('connect');
	}
	
	public function redirect()
	{
	
		require_once(APPPATH . 'libraries/twitteroauth.php');
		
		$connection = new TwitterOAuth($this->config->item('oauth_consumer_key'), $this->config->item('oauth_consumer_secret'));
		
		$temporary_credentials = $connection->getRequestToken($this->config->item('oauth_callback_url'));
		
		print_r($temporary_credentials);
		
	}
	
	public function callback()
	{
		
	}
	
}