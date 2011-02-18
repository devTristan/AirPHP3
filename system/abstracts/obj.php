<?php
class obj extends base {
	protected function driver_exists($driver)
		{
		$class = 'driver_'.get_called_class().'_'.$driver;
		airphp_autoload($class);
		return class_exists($class);
		}
	protected function driver($driver)
		{
		return new 'driver_'.get_called_class().'_'.$driver;
		}
}
