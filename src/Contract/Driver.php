<?php namespace Grabber\Contract;

interface Driver {

	public function createData($classname, array $options=[]);

	public function get($selector='*');

	public function times($time);
}