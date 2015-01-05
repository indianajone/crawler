<?php namespace spec\Grabber\Utils;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ThaiDateSpec extends ObjectBehavior
{
	const DATE_PATTERN = '/(\d{1,2})(?:\s)(.+?)(?:\s)(\d{2,4})/';

    function it_parse_thai_date_to_gregorain_date()
    {
    	$dt = $this->parse(self::DATE_PATTERN, '01 มกราคม 2557');

    	$dt->year()->shouldReturn(2014);

    	$dt->month()->shouldReturn(1);

    	$dt->date()->shouldReturn(1);
    }

    function it_parse_thai_date_with_short_hand_month_name_to_gregorain_date()
    {
    	$dt = $this->parse(self::DATE_PATTERN, '01 ม.ค. 2557');

    	$dt->year()->shouldReturn(2014);

    	$dt->month()->shouldReturn(1);

    	$dt->date()->shouldReturn(1);
    }

    function it_format_date_to_string_as_given_format()
    {
    	$dt = $this->parse(self::DATE_PATTERN, '01 มกราคม 2557');

    	$dt->format('Y-m-d H:i:s')->shouldReturn('2014-01-01 00:00:00');

    	$dt->format('Y-m-d')->shouldReturn('2014-01-01');
    }
}
