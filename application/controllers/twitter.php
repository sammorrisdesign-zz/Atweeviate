<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {

	private $connection;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('twitteroauth');

		//print_r($this->session->userdata());

		if($this->session->userdata('oauth_access_token') && $this->session->userdata('oauth_access_token_secret'))
		{
			// If user already logged in

			$this->connection = $this->twitteroauth->create($this->config->item('oauth_consumer_key'), $this->config->item('oauth_consumer_secret'), $this->session->userdata('oauth_access_token'),  $this->session->userdata('oauth_access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('oauth_consumer_key'), $this->config->item('oauth_consumer_secret'), $this->session->userdata('oauth_access_token'), $this->session->userdata('oauth_access_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('oauth_consumer_key'), $this->config->item('oauth_consumer_secret'));
		}
	}

	public function index()
	{

		if($this->session->userdata('oauth_access_token') && $this->session->userdata('oauth_access_token_secret'))
		{
			$this->load->view('client');
		}
		else
		{
			$this->load->view('connect');
		}

	}

	/**
	 * Here comes authentication process begin.
	 * @access	public
	 * @return	void
	 */
	public function authenticate()
	{
		if($this->session->userdata('oauth_access_token') && $this->session->userdata('oauth_access_token_secret'))
		{
			// User is already authenticated. Add your user notification code here.
			redirect(base_url('/'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('/twitter/callback'));

			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);

			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				redirect($url);
			}
			else
			{
				// An error occured. Make sure to put your error notification code here.
				redirect(base_url('/twitter/error'));
			}
		}
	}

	/**
	 * Callback function, landing page for twitter.
	 * @access	public
	 * @return	void
	 */
	public function callback()
	{
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
		{
			$this->reset_session();
			redirect(base_url('/twitter/authenticate'));
		}
		else
		{
			$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

			if ($this->connection->http_code == 200)
			{
				$this->session->set_userdata('oauth_access_token', $access_token['oauth_token']);
				$this->session->set_userdata('oauth_access_token_secret', $access_token['oauth_token_secret']);
				$this->session->set_userdata('twitter_user_id', $access_token['user_id']);
				$this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);

				$this->session->unset_userdata('request_token');
				$this->session->unset_userdata('request_token_secret');

				redirect(base_url('/'));
			}
			else
			{
				// An error occured. Add your notification code here.
				redirect(base_url('/'));
			}
		}
	}

	function reset()
	{
		$this->session->unset_userdata('oauth_access_token');
		$this->session->unset_userdata('oauth_access_token_secret');
		$this->session->unset_userdata('request_token');
		$this->session->unset_userdata('request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
	}

	public function logout()
	{
		$this->session->unset_userdata('oauth_access_token');
		$this->session->unset_userdata('oauth_access_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
		redirect(base_url('/'));
	}
	
}