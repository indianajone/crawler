<?php namespace Grabber;

class HtmlGrabber extends Grabber
{
	/**
	 * @var Goutte\Client
	 */
	// protected $client = 'GuzzleHttp\Client';
	protected $client = 'Goutte\Client'; 
	

	public function fetch($url)
	{
		return $this->client->request('GET', $url);
	}
}
