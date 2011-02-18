<?php
class url extends library {
private static $url, $path;
	public static function run($application = '', $path = '')
		{
		if (func_num_args() == 0)
			{
			foreach (config::get('applications') as $app => $data)
				{
				if ( str::begins_with(self::path(), $data['root']) )
					{
					$application = $app;
					$path = substr(self::path(), strlen($data['root']));
					break;
					}
				}
			}
		if (!$application) {return 404;}
		
		$oldroots = roots();
		roots(array(DIR_APPLICATION.$application.'/', DIR_SYSTEM));
		$routes = config::get('routes');
		
		if (self::path() == '')
			{
			$file = $routes['index'];
			}
		else
			{
			if (!isset($routes['routes'][self::path()])) {return 404;}
			$file = $routes['routes'][self::path()];
			}
		show::page($file);
		}
	public static function path()
		{
		if (isset(self::$path)) {return self::$path;}
		self::generate();
		return self::$path = str::before_first(self::$url, '?');
		}
	private static function generate()
		{
		if (!isset(self::$url))
			{
			self::$url = substr( $_SERVER['REQUEST_URI'], strlen(config::get('server', 'url_base')) );
			}
		}
}
