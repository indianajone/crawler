<?php namespace Grabber;

class App {

	public function run()
	{
		$data = Factory::make('html')
						->createData('Grabber\Parser\Lotto\Kapook');

		dd($data);
	}	
}