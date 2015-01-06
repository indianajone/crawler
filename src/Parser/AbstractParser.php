<?php namespace Grabber\Parser;

use InvalidArgumentException;
use Grabber\Contract\Driver;
use Grabber\Exception\TransformerNotFoundException;
use Grabber\Utils\ThaiDate;
use ReflectionClass;

abstract class AbstractParser {
	
	/**
	 * @var Grabber\Contract\Driver
	 */
	protected $driver;

	/**
	 * Path to your origin source
	 * @var String
	 */
	protected $path;
	
	function __construct(Driver $driver)
	{
		$this->driver = $driver;
	}

	public function getUrl()
	{
		if (!isset($this->path))
		{
			throw new InvalidArgumentException('Please set property [$path] to your origin source');
		}

		return $this->path;
	}

	public function setUrl($url)
	{
		$this->path = $url;
	}

	public function transform()
	{
		return $this->getTransformer()->transform($this);
	}

	public function strip_html_tags($html)
	{
		$html = preg_replace('/\s+/', '', $html);
		
		return  preg_replace('#<[^>]+>#', '&nbsp;', $html);
	}

	public function toArray($data)
	{
		return preg_split('/[^\d]+/', trim($this->cleanNonBreakingSpace($data)));
	}

	protected function getTransformer()
	{
		$transformer = $this->guessTransformerName();

		if(!class_exists($transformer))
		{
			throw new TransformerNotFoundException("Can not find [ $transformer ]");
		}

		return new $transformer;
	}

	protected function guessTransformerName()
	{
		$namespace = (new ReflectionClass($this))->getNamespaceName();

		return preg_replace('/Parser/', 'Transformer', $namespace) . 'Transformer';
	}

	protected function cleanNonBreakingSpace($str)
	{
		$htmlStr = mb_convert_encoding($str, 'HTML-ENTITIES');

		return html_entity_decode(preg_replace('/&nbsp;/', ' ', $htmlStr));
	}

	protected function toDateTimeString($pattern, $date)
	{
		return ThaiDate::parse($pattern, $date)->format();
	}

}