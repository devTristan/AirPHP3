<?php
class field_ip extends basefield {
	public function set($value)
		{
		return number::from_ip($value);
		}
	public function get($value)
		{
		return number::to_ip($value);
		}
	public function args($args)
		{
		return 10;
		}
	public function type($args)
		{
		return 'int';
		}
	public function unsigned($args)
		{
		return true;
		}
}
