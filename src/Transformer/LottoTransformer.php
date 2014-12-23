<?php namespace Grabber\Transformer;

use Grabber\Contract\Lotto;

class LottoTransformer {
	
	public function transform(Lotto $data)
	{
		return [
			'date' 		=> 	$data->date(),
			'back3' 	=> 	$data->backThree(),
			'back2' 	=> 	$data->backTwo(),
			'first' 	=> 	$data->firstPrize(),
			'second' 	=> 	$data->secondPrize(),
			'third' 	=> 	$data->thirdPrize(),
			'forth' 	=> 	$data->forthPrize(),
			'fifth'		=>	$data->fifthPrize()
		];
	}
}