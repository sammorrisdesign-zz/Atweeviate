<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public $api_url = 'http://words.bighugelabs.com/api/2';
	public $api_key = 'a606d540119f33c508a043ce724fe5f8';
	public $api_format = 'json';

	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		$words = $this->uri->segment(3, 0);

		$response = '';

		foreach (explode(',', $words) as $word) {
			$url = $this->getRequestUrl($word);

			$response .= $this->curl->simple_get($url);
		}

		$this->output->set_content_type('application/json')->set_output($response);
	}

	/**
	 * Get API request URL
	 * @access	public
	 * @return	void
	 */
	public function getRequestUrl($word = '')
	{
		$url = sprintf('%s/%s/%s/%s', $this->api_url, $this->api_key, $word, $this->api_format);

		return $url;
	}

}