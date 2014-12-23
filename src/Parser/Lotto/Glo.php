<?php namespace Grabber\Parser\Lotto;

use \InvalidArgumentException;
use Grabber\Parser\AbstractParser;
use Grabber\Contract\Lotto;

class Glo extends AbstractParser implements Lotto {

	/**
	 * Path to your origin source
	 * @var String
	 */
	protected $path = 'http://www.glo.or.th/code/code1395.php?filename=index';

	public function date()
	{
		return $this->driver->first()->filter('.bigBold1')->text();
	}

	public function backTwo()
	{
		return $this->driver
					->filterXpath('//td[@bgcolor="#B9EBFB"]')
					->filterXpath('//table/tr[3]/td[3]')
					->text();
	}

	public function backThree()
	{
		$data = $this->driver->first()->filter('.bigBold')->html();
		
		// Split anything thats not digit.
		return preg_split('/[\D]+/', $data);
	}

	public function firstPrize()
	{
		return $this->driver->first()->filter('.bigBold2')->text();
	}

	public function secondPrize()
	{
		return null;
	}	

	public function thirdPrize()
	{
		return null;
	}

	public function forthPrize()
	{
		return null;
	}

	public function fifthPrize()
	{
		return null;
	}
}