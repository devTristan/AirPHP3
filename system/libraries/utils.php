<?php
class utils extends library {
	public function merge ($array, $__dummy)
		{
		$args = func_get_args();
		array_shift($args);
		foreach ($args as &$arg)
			{
			foreach ($arg as $field => $value)
				{
				$arg[$field] = $value;
				}
			}
		return $args;
		}
}
