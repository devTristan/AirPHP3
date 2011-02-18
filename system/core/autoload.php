<?php
/*
	Searches (application|system)/(libraries|objects|abstracts)/class(/class?).php
*/
function airphp_autoload($class)
	{
	$paths = array(LIBRARIES, OBJECTS, ABSTRACTS);
	
	if (substr($class, 0, strlen('driver_')) == 'driver_')
		{
		$parts = explode('_', $class);
		array_shift($parts);
		$whos_driver = array_shift($parts);
		$filename = implode('_', $parts);
		foreach (roots() as $root)
			{
			$file = $root.DRIVERS.'/'.$whos_driver.'/'.$filename.PHPEX;
			if (file_exists($file))
				{
				require_once($file);
				return;
				}
			}
		return;
		}
	
	foreach (roots() as $root)
		{
		foreach ($paths as $path)
			{
			if (file_exists("$root$path/$class".PHPEX))
				{
				require_once("$root$path/$class".PHPEX);
				return;
				}
			if (file_exists("$root$path/$class/$class".PHPEX))
				{
				require_once("$root$path/$class/$class".PHPEX);
				return;
				}
			}
		}
	}

spl_autoload_register('airphp_autoload');
