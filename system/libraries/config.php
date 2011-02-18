<?php
class config extends library {
private static $config = array();
	public static function get($file, $key = null, $default = null)
		{
		if ( !isset(self::$config[$file]) )
			{
			self::$config[$file] = array();
			foreach (roots() as $root)
				{
				self::$config[$file] = data::load($root.CONFIG.'/'.$file);
				if (self::$config[$file]) {break;}
				}
			}
		switch (func_num_args())
			{
			case 1: return self::$config[$file];
			case 2: return self::$config[$file][$key];
			default: return isset(self::$config[$file][$key]) ? self::$config[$file][$key] : $default;
			}
		}
}
