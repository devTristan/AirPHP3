<?php
class data extends library {
	public static function load($file)
		{
		$files = glob($file.'.*');
		if (!$files) {return false;}
		$file = $files[0];
		$ext = str::after_last($file, '.');
		if (!self::driver_exists($ext)) {return false;}
		$driver = self::driver($ext);
		return $driver::load($file);
		}
}
