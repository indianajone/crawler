<?php namespace Grabber\Parser;

use Carbon\Carbon;
use \InvalidArgumentException;
use Grabber\Contract\Driver;
use Grabber\Exception\TransformerNotFoundException;
use Grabber\Transformer\LottoTransformer;
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
		if (!isset($this->path) or !filter_var($this->path, FILTER_VALIDATE_URL))
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

	protected function toDateTimeString($pattern, $subject)
	{
		preg_match($pattern, $subject, $matches);

		$month = [
			'มกราคม' => 1,
			'กุมภาพันธ์'  => 2,
			'มีนาคม' => 3,
			'เมษายน' => 4,
			'พฤษภาคม' => 5,
			'มิถุนายน' => 6,
			'กรกฎาคม' => 7,
			'สิงหาคม' => 8,
			'กันยายน' => 9,
			'ตุลาคม' => 10,
			'พฤศจิกายน' => 11,
			'ธันวาคม' => 12
		];

		$date = Carbon::createFromDate($matches[3]-543, $month[$matches[2]], $matches[1])->timezone('Asia/Bangkok');

		return $date->toDateTimeString();
	}

}