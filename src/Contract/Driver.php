<?php namespace Grabber\Contract;

interface Driver {

	public function createData($classname);

	public function get($selector='*');

	public function times($time);
}