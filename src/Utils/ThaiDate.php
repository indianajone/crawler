<?php namespace Grabber\Utils;

use Carbon\Carbon;
use Exception;

class ThaiDate {

    /**
     * The number of year differents.
     */
    const YEAR_DIFF = 543;

     /**
     * The default timezone.
     */
    const TIMEZONE = 'Asia/Bangkok';

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

    public function __construct($year=null, $month=null, $date=null)
    {
        $this->year = $year;

        $this->month = $month;

        $this->date = $date;
    }

    public static function parse($pattern, $date)
    {
        preg_match($pattern, $date, $matches);

        if(!$matches)
        {
            throw new Exception("No matches were found on given pattern. Please check you date pattern.", 404);
        }

        array_shift($matches);

        list($date, $month, $year) = array_pad($matches, 2, null);

        return new static($year, $month, $date);
    } 

    public function year()
    {
        return $this->year - self::YEAR_DIFF;
    }

    public function month()
    {
        $monthNum = 0;

        // Check if provided in fullname
        if( in_array($this->month, static::$months_full) )
        {
            $monthNum = array_search($this->month, static::$months_full);
        }
        // Or if provided in short name
        else if( in_array($this->month, static::$months_abbrev) )
        {
            $monthNum = array_search($this->month, static::$months_abbrev);
        }
        
        return $monthNum;
    }

    public function date()
    {
        return (int) $this->date;
    }

    public function format($format=null)
    {
        $format = $format ?: Carbon::DEFAULT_TO_STRING_FORMAT;

        return Carbon::create($this->year(), $this->month(), $this->date(), 0, 0, 0, self::TIMEZONE)->format($format);
    }
}