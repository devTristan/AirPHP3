<?php
function roots($newroots = null)
	{
	static $roots = array(DIR_SYSTEM);
	if (func_num_args() == 1) {$roots = $newroots;}
	return $roots;
	}
