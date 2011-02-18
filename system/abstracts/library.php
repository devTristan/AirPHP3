<?php
class library extends base {
	protected static function driver_exists($driver)
		{
		$class = 'driver_'.get_called_class().'_'.$driver;
		airphp_autoload($class);
		return class_exists($class);
		}
	protected static function driver($driver)
		{
		return 'driver_'.get_called_class().'_'.$driver;
		}
}
