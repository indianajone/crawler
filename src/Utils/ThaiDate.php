<?php namespace Grabber\Utils;

use DateTime;

class ThaiDate {

	/**
	 * The number of year differents.
	 */
	const YEAR_DIFF = 543;

	/**
     * The month constants.
     */
    const JANUARY = 1;
    const FEBRUARY = 2;
    const MARCH = 3;
    const APRIL = 4;
    const MAY = 5;
    const JUNE = 6;
    const JULY = 7;
    const AUGUST = 8;
    const SEPTEMBER = 9;
    const OCTOBER = 10;
    const NOVEMBER = 11;
    const DECEMBER = 12;
	
	/**
     * Fullnames of month.
     *
     * @var array
     */
    protected static $months_full = [
		self::JANUARY => 'มกราคม',
		self::FEBRUARY => 'กุมภาพันธ์',
		self::MARCH => 'มีนาคม',
		self::APRIL => 'เมษายน',
		self::MAY => 'พฤษภาคม',
		self::JUNE => 'มิถุนายน',
		self::JULY => 'กรกฎาคม',
		self::AUGUST => 'สิงหาคม',
		self::SEPTEMBER => 'กันยายน',
		self::OCTOBER => 'ตุลาคม',
		self::NOVEMBER => 'พฤศจิกายน',
		self::DECEMBER => 'ธันวาคม'
    ];

    /**
     * Shortnames of month.
     *
     * @var array
     */
    protected static $months_abbrev = [
		self::JANUARY => 'ม.ค.',
		self::FEBRUARY => 'ก.พ.',
		self::MARCH => 'ม.ค.',
		self::APRIL => 'เม.ย.',
		self::MAY => 'พ.ค.',
		self::JUNE => 'มิ.ย.',
		self::JULY => 'ก.ค.',
		self::AUGUST => 'ส.ค.',
		self::SEPTEMBER => 'ก.ย.',
		self::OCTOBER => 'ต.ค.',
		self::NOVEMBER => 'พ.ย.',
		self::DECEMBER => 'ธ.ค.'
    ];    

    protected $year;

    protected $month;

    protected $date;

    public function __construct($data=[])
    {
    	$this->year = isset($data[3]) ? $data[3] : date('Y');

    	$this->month = isset($data[2]) ? $data[2] : date('n');

    	$this->date = isset($data[1]) ? $data[1] : date('j');
    }

    public static function parse($pattern, $date)
    {
    	preg_match($pattern, $date, $matches);

    	return (new static($matches))->getDateTime();
    } 

    public function getDateTime()
    {
    	$format = $this->getYear().'-'.$this->getMonth().'-'.$this->getDate();
		
		return new DateTime($format);
    }

    public function getYear()
    {
    	return $this->year - self::YEAR_DIFF;
    }

    public function getMonth()
    {
    	$monthNum = 0;

    	// Check if provided in fullname
    	if( in_array($this->month, static::$months_full) )
    	{
    		$monthNum = array_search($this->month, static::$months_full);
    	}

    	// Or if provided in short name
    	if( in_array($this->month, static::$months_abbrev) )
    	{
    		$monthNum = array_search($this->month, static::$months_abbrev);
    	}
    	
    	return $monthNum;
    }

    public function getDate()
    {
    	return $this->date;
    }
}