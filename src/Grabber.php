<?php namespace Grabber;

use Grabber\Contract\Grabable;
use InvalidArgumentException;

abstract class Grabber implements Grabable
{
	protected $client;

	public function __construct()
	{
		$this->propertyMustBeSet();
		
		$this->isClientClassExists();
		
		$this->client = new $this->client;
	}

	protected function propertyMustBeSet()
	{
		if ( is_null($this->client) )
			throw new InvalidArgumentException('Please set your property [ $client ]');
	}

	protected function isClientClassExists()
	{
		if ( ! class_exists($this->client)) 
			throw new InvalidArgumentException("Your provided client class [ {$this->client} ] does not exists.");
	}

	public function isValidRss($rss)
	{
		if( ! isset($rss->channel->item) )
			throw new InvalidArgumentException("RSS feed you have provide is invalid.");
	}

	public function getClient()
	{
		return $this->client;
	}

	public function setClient($client)
	{
		$this->client = $client;
	}
}
