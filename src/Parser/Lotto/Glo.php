<?php namespace Grabber\Parser\Lotto;

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
		$date = $this->cleanNonBreakingSpace($this->driver->get('.bigBold1'), 'HTML-ENTITIES');

		return $this->toDateTimeString('/(\d{1,2}(?![^\s]+)?)(?:\s+)?(.[^\s]+)(?:\s+)(?:.+)?(\d{4})/', $date);
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
		return preg_split('/[^\d]+/', $data);
	}

	public function firstPrize()
	{
		return $this->driver->get('.bigBold2');
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