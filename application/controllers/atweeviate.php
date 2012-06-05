<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atweeviate extends CI_Controller {

	public $api_url = 'http://words.bighugelabs.com/api/2';
	public $api_key = 'a606d540119f33c508a043ce724fe5f8';

	public function __construct()
	{
		parent::__construct();

		$word = $this->uri->segment(2, 0);

		$this->curl->simple_get($this->getRequestUrl($word));
	}

	/**
	 * Get API request URL
	 * @access	public
	 * @return	void
	 */
	public function getRequestUrl($word = '')
	{
		$url = sprintf('%s/%s/%s', $this->api_url, $this->api_key, $word);

		return $url;
	}

}