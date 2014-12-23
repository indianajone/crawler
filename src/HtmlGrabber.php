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
		// $request = $this->client->get($url, ['future' => true]);
		// $request->send();

		// return $request;
		return $this->client->request('GET', $url);
	}
}
