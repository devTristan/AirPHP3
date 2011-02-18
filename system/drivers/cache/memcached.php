<?php
class driver_cache_memcached extends driver {
private $link;
	public function __construct()
		{
		$this->link = memcache_connect(
			config::get('memcached', 'address', '127.0.0.1'),
			config::get('memcached', 'port', 11211)
			);
		}
	public function get($item)
		{
		return memcache_get($this->link, $item);
		}
	public function set($item, $value, $time = -1)
		{
		if ($time == -1) {$time = 2592000;}
		memcache_set($this->link, $item, $value, 0, $time);
		return true;
		}
	public function exists($item)
		{
		return ($this->get($item)) ? true : false;
		}
	public function remove($item)
		{
		memcache_delete($this->link, $item);
		}
	public function clear()
		{
		memcache_flush($this->link);
		}
}
