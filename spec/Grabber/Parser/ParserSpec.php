<?php namespace spec\Grabber\Parser;

use Grabber\Contract\Driver;
use Grabber\Parser\AbstractParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserSpec extends ObjectBehavior
{
	function let(Driver $driver)
	{
		$this->beAnInstanceOf('spec\Grabber\Parser\Foo\Foo');

		$this->beConstructedWith($driver);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('spec\Grabber\Parser\Foo\Foo');
    }

	function it_transform_parsed_data_to_json()
	{
		$this->transform($this)->shouldReturn([]);
	}
}

namespace spec\Grabber\Parser\Foo;
class Foo extends \Grabber\Parser\AbstractParser {}

namespace spec\Grabber\Transformer;
class FooTransformer {
	public function transform($data) {
		return [];
	}
}
