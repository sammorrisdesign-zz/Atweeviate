<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {

	private $connection;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('twitteroauth');

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
			$data = array(
				'username' => $this->session->userdata('twitter_screen_name'),
				'name' => $this->session->userdata('name'),
				'avatar' => $this->session->userdata('avatar')
			);

			$this->load->view('client', $data);
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
			$request_token = $this->connection->getRequestToken($this->config->item('oauth_callback_url'));

			$this->session->set_userdata(
				array(
					'request_token' => $request_token['oauth_token'],
					'request_token_secret' => $request_token['oauth_token_secret']
				)
			);

			if($this->connection->http_code === 200)
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
			$this->reset();
			redirect(base_url('/twitter/authenticate'));
		}
		else
		{
			$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'), $this->input->get('oauth_token'));

			if ($this->connection->http_code === 200)
			{
				$account = $this->connection->get('account/verify_credentials');

				$this->session->set_userdata(
					array(
						'oauth_access_token' => $access_token['oauth_token'],
						'oauth_access_token_secret' => $access_token['oauth_token_secret'],
						'twitter_user_id' => $access_token['user_id'],
						'twitter_screen_name' => $access_token['screen_name'],
						'name' => $account->name,
						'avatar' => $account->profile_image_url
					)
				);

				$this->session->unset_userdata('request_token');
				$this->session->unset_userdata('request_token_secret');

				redirect(base_url('/'));
			}
			else
			{
				// An error occured. Add your notification code here.
				redirect(base_url('/twitter/error'));
			}
		}
	}

	public function reset()
	{
		$this->session->sess_destroy();
	}

	public function logout()
	{
		$this->reset();
		redirect(base_url('/'));
	}

	public function publish()
	{
		$message = $this->input->get_post('tweet', TRUE);
		$data = array(
	    'status' => $message
		);
		$result = $this->connection->post('statuses/update', $data);
		redirect(base_url('/'));
	}
	
}