<?php
class driver_data_yaml extends driver {
	public static function load($file)
		{
		return yaml::load($file);
		}
}
