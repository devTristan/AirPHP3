<?php
function __stripslashes_recursive(&$value)
	{
	return $value = (is_array($value)) ? array_map('__stripslashes_recursive', $value) : stripslashes($value);
	}
__stripslashes_recursive($_GET);
__stripslashes_recursive($_POST);
__stripslashes_recursive($_COOKIE);
