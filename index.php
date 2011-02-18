<?php
define('PHPEX', '.php');
define('DIR_BASE', dirname(__FILE__).'/');
require(DIR_BASE.'paths'.PHPEX);

if (!version_compare(PHP_VERSION, '6.0.0-dev', '>='))
	{
	//If magic quotes is on, fix it
	if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		{
		require_once(DIR_FIXES.'magic_quotes.php');
		}
	//If register globals is on, deregister them
	if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on' || !function_exists('ini_get'))
		{
		require_once(DIR_FIXES.'register_globals.php');
		}
	}

require(DIR_CORE.'autoload'.PHPEX);
require(DIR_CORE.'roots'.PHPEX);

//Environment is now prepared

output::start();

//events::trigger('start');

$result = url::run();

if ($result)
	{
	show::view('views/errors/'.$result);
	}
