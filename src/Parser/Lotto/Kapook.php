<?php namespace Grabber\Parser\Lotto;

use Grabber\Parser\AbstractParser;
use Grabber\Contract\Lotto;

class Kapook extends AbstractParser implements Lotto {

	/**
	 * Path to your origin source
	 * @var String
	 */
	protected $path = 'http://lottery.kapook.com';

	public function date()
	{
		return $this->driver->get('#spLottoDate');
	}

	public function backTwo()
	{
		return $this->driver->get('#d2');
	}

	public function backThree()
	{
		return $this->driver->times(4)->get('[id="d3:%s"]');
	}

	public function firstPrize()
	{
		return $this->driver->get('#no1');
	}

	public function secondPrize()
	{
		return $this->driver->times(5)->get('[id="no2:%s"]');
	}	

	public function thirdPrize()
	{
		return $this->driver->times(10)->get('[id="no3:%s"]');
	}

	public function forthPrize()
	{
		return $this->driver->times(50)->get('[id="no4:%s"]');
	}

	public function fifthPrize()
	{
		return $this->driver->times(100)->get('[id="no5:%s"]');
	}
}