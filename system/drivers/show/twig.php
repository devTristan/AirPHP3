<?php
class driver_show_twig extends driver {
private static $loader, $twig;
private static $is_initialized = false;
	private static function init()
		{
		if (self::$is_initialized) {return;}
		self::$is_initialized = true;
		require_once DIR_SYSTEM.VENDOR.'/Twig/Autoloader'.PHPEX;
		Twig_Autoloader::register();
		
		$roots = roots();
		foreach ($roots as &$root)
			{
			$root = substr($root, 0, -1);
			}
		self::$loader = new Twig_Loader_Filesystem($roots);
		self::$twig = new Twig_Environment(self::$loader, array(
			'cache' => DIR_CACHE.'twig',
			'auto_reload' => true
			));
		}
	public static function show($file, $data = array())
		{
		self::init();
		$template = self::$twig->loadTemplate($file);
		echo $template->render($data);
		}
}
