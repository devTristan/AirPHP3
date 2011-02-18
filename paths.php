<?php
//If you want to restructure the filesystem, edit this file
define('SYSTEM', 'system');

define('ABSTRACTS', 'abstracts');
define('CONFIG', 'config');
define('CORE', 'core');
define('FIXES', 'fixes');
define('CONTROLLERS', 'controllers');
define('DRIVERS', 'drivers');
define('LIBRARIES', 'libraries');
define('MODELS', 'models');
define('OBJECTS', 'objects');
define('VENDOR', 'vendor');
define('VIEWS', 'views');

define('STORAGE', 'storage');
define('CACHE', 'cache');

define('APPLICATION', 'application');

define('DIR_SYSTEM', DIR_BASE.SYSTEM.'/');
define('DIR_APPLICATION', DIR_BASE.APPLICATION.'/');
define('DIR_CORE', DIR_SYSTEM.CORE.'/');
define('DIR_FIXES', DIR_SYSTEM.CORE.'/'.FIXES.'/');
define('DIR_STORAGE', DIR_SYSTEM.STORAGE.'/');
define('DIR_CACHE', DIR_STORAGE.CACHE.'/');
