<?php
class field_email extends basefield {
	public function type($args)
		{
		return 'varchar';
		}
	public function args($args)
		{
		return $args[0];
		}
}
