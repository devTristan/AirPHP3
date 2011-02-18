<?php
class show extends library {
	public static function controller($controller, $data = array())
		{
		if (!self::page(CONTROLLERS.'/'.$controller, $data))
			{
			error::user("View not found: $controller");
			}
		}
	public static function view($view, $data = array())
		{
		if (!self::page(VIEWS.'/'.$view, $data))
			{
			error::user("View not found: $view");
			}
		}
	public static function page($path, $data = array())
		{
		foreach (roots() as $root)
			{
			$file = $root.$path;
			if (!file_exists($file))
				{
				continue;
				}
			foreach ($data as $__var => $__value)
				{
				$$__var = $__value;
				}
			$parts = array_reverse(explode('.', $file));
			$ext = $parts[0];
			$filter = (isset($parts[1])) ? $parts[1] : null;
			if (!self::driver_exists($filter)) {$filter = null;}
			
			if ($filter)
				{
				$driver = self::driver($filter);
				$driver::show($file, $data);
				}
			else
				{
				include($file);
				}
			return true;
			}
		return false;
		}
}
