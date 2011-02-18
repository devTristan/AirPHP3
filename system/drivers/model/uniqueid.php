<?php
class field_uniqueid extends basefield {
	public function args($args)
		{
		return $args[0];
		}
	public function type($args)
		{
		return 'char';
		}
	public function insert($args, $vars)
		{
		$id = str::random(str::alphanumeric, $args[0]);
		//TODO: check for existence first
		return $id;
		}
}
