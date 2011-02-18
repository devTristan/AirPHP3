<?php
class driver_data_php extends driver {
	public function load($file)
		{
		return include($file);
		}
}
