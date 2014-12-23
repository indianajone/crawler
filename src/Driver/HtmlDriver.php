<?php namespace Grabber\Driver;

use Grabber\Contract\Driver;
use Grabber\Exception\ParserNotFoundException;
use Grabber\HtmlGrabber;

class HtmlDriver implements Driver
{
	/**
	 * @var Symfony\Component\DomCrawler\Crawler
	 */
	protected $crawler;

	protected $parser;

	/**
	 * Counter
	 * @var integer
	 */
	protected $times = 1;

	public function times($time)
	{
		$this->times = $time;

		return $this;
	}

	public function get($selector='*')
	{
		$num = [];

		foreach(range(1, $this->times) as $i)
		{
			$num[] = $this->filter(sprintf($selector, $i))->text();
		}

		$this->resetCounter();

		return count($num) > 1 ? $num : $num[0];
	}

	public function createData($classname)
	{
		$this->setParser($classname);

		$crawler = $this->getClient()->fetch($this->parser->getUrl());

		$this->setCrawler($crawler);

		return $this->parser->transform();
	}

	private function setParser($classname)
	{
		if(!class_exists($classname))
		{
			throw new ParserNotFoundException("Could not find Parser [$classname]");
		}

		$this->parser = $this->parser ?: new $classname($this);
	}

	private function getClient()
	{
		return new HtmlGrabber;
	}

	private function setCrawler($crawler)
	{
		$this->crawler = $crawler;

		return $this;
	}

	private function resetCounter()
	{
		$this->times = 1;
	}

	public function __call($method, $parameters)
	{
		return call_user_func_array([$this->crawler, $method], $parameters);
	}
}