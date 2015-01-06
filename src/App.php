<?php namespace Grabber;

class App {

	public function run()
	{
		$data = Factory::make('html')
						->createData('Grabber\Parser\Lotto\Sanook');

		dd($data);
	}	
}