<?php
class output extends library {
private static $headers = array();
private static $cookies = array();
private static $filters = array();
private static $cachetime = 0;
private static $rawheaders;
private static $headers_sent = false;
	public static function start()
		{
		ob_start(array('self', 'run_filters'));
		//register_shutdown_function(array(self, 'end'));
		//$this->hook('shutdown', 'end');
		self::header('Content-Type','text/html');
		}
	public static function end()
		{
		self::header('Content-Length', ob_get_length());
		self::send_headers();
		if (self::$cachetime)
			{
			$file = DIR_CACHE.'output_'.sha1(url::path());
			file_put_contents($file,
				(time()+self::$cachetime)."\n".
				json_encode(self::$rawheaders)."\n".
				ob_get_contents()
				);
			}
		@ob_end_flush();
		if (function_exists('fastcgi_finish_request')) {fastcgi_finish_request();}
		}
	public static function filter($filter, $ext)
		{
		self::$filters[] = array($filter, $ext);
		}
	public static function run_filters($data)
		{
		foreach (self::$filters as $filter)
			{
			//TODO
			//$data = s('parser')->parse($data, array($filter[0]), $filter[1]);
			}
		return $data;
		}
	public static function send_headers()
		{
		if (self::$headers_sent) {return $this;}
		self::$rawheaders = array('status' => false, 'normal' => array());
		foreach (self::$headers as $field => $value)
			{
			if ($field == 'Status')
				{
				$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : false;
				$prefix = (substr(php_sapi_name(), 0, 3) == 'cgi') ? 'Status:' : (($server_protocol == 'HTTP/1.0') ? 'HTTP/1.0' : 'HTTP/1.1');
				if (is_numeric($value))
					{
					$code = $value;
					}
				else
					{
					$code = (int) substr($value,0,3);
					}
				self::$rawheaders['status'] = array($prefix.' '.$value,$code);
				header($prefix.' '.$value,true,$code);
				}
			else
				{
				self::$rawheaders['normal'][] = $field.': '.$value;
				header($field.': '.$value,true);
				}
			}
		$this->headers = array();
		foreach (self::$cookies as $cookie)
			{
			call_user_func_array('setcookie', $cookie);
			}
		self::$cookies = array();
		}
	public static function flush()
		{
		self::send_headers();
		self::$headers_sent = true;
		@flush();
		@ob_flush();
		}
	public static function cache($cachetime)
		{
		self::$cachetime = $cachetime;
		}
	public static function client_cache($cachetime)
		{
		$cachetime = (int) $cachetime;
		self::header('Cache-Control', 'public, max-age='.$cachetime);
		}
	public static function header($field,$value = null)
		{
		if ($value === null)
			{
			$value = $field;
			$field = 'Status';
			}
		self::$headers[$field] = $value;
		}
	public static function set_cookie($item, $value, $timeout = null, $path = null, $domain = null, $secure = null, $httponly = null)
		{
		if ($timeout === null) {$timeout = config::get('cookies', 'default_timeout');}
		if ($path === null) {$path = config::get('cookies', 'path');}
		if ($domain === null) {$domain = config::get('cookies', 'domain');}
		if ($secure === null) {$secure = config::get('cookies', 'secure');}
		if ($httponly === null) {$httponly = config::get('cookies', 'httponly');}
		$item = config::get('cookies', 'prefix').$item;
		self::$cookies[$item] = array($item, $value, $timeout, $path, $domain, $secure, $httponly);
		}
	public static function redirect($url, $permanent = false)
		{
		if ($permanent) {self::header(301);}
		self::header('Location', $url);
		}
}
