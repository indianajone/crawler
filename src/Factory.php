<?php namespace Grabber;

use Grabber\Exception\DriverNotFoundException;

class Factory {

	public static function make($name)
	{
		$drivername = ucfirst($name);
        
        $driverclass = sprintf('Grabber\\Driver\\%sDriver', $drivername);

        if (!class_exists($driverclass)) 
        {    
            throw new DriverNotFoundException("Driver [ $driverclass ] could not be found.");
        }

        return new $driverclass;
	}
}