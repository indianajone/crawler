<?php namespace Grabber\Parser\Lotto;

use Grabber\Parser\AbstractParser;
use Grabber\Contract\Lotto;

class Sanook extends AbstractParser implements Lotto {

	/**
	 * Path to your origin source
	 * @var String
	 */
	protected $path = 'http://news.sanook.com/lotto/check/หวย-ผลสลากกินแบ่งรัฐบาลงวดประจำวันที่-16-มกราคม-2550/';

	public function date()
	{
		$date = $this->driver->get('#lottoh2');

		return $this->toDateTimeString('/(\d{1,2}(?![^\s]+)?)(?:\s+)?(.[^\s]+)(?:\s+)(?:.+)?(\d{4})/', $date);
	}

	public function backTwo()
	{
		return $this->driver->get('.lot-two');;
	}

	public function backThree()
	{
		$data = $this->driver->get('td.lot-three');

		return preg_split('/[^\d]+/', $data);
	}

	public function firstPrize()
	{
		return $this->driver->get('.lot-one');
	}

	public function secondPrize()
	{
		$html = $this->driver
					->filterXpath('//*[@id="toc"]/div[2]/div[2]/table[2]/tr[2]')
					->html();

		return $this->toArray($this->strip_html_tags($html));
	}	

	public function thirdPrize()
	{
		$html = $this->driver
					->filterXpath('//*[@id="toc"]/div[2]/div[2]/table[3]/tr[3]')
					->html();

		$html .= $this->driver
					->filterXpath('//*[@id="toc"]/div[2]/div[2]/table[3]/tr[4]')
					->html();

		return $this->toArray($this->strip_html_tags($html));;
	}

	public function forthPrize()
	{
		$html = '';

		foreach (range(3,12) as $index)
		{
			$html .= $this->driver
					->filterXpath('//*[@id="toc"]/div[2]/div[2]/table[4]/tr['.$index.']')
					->html();
		}

		return $this->toArray($this->strip_html_tags($html));
	}

	public function fifthPrize()
	{
		$html = '';

		foreach (range(3,22) as $index)
		{
			$html .= $this->driver
					->filterXpath('//*[@id="toc"]/div[2]/div[2]/table[5]/tr['.$index.']')
					->html();
		}

		return $this->toArray($this->strip_html_tags($html));
	}
}