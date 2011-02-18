<?php
class error extends library {
	public function user($msg)
		{
		output::header(500);
		show::view('views/errors/user.html', array('message' => $msg));
		}
	public function db($title, $msg)
		{
		output::header(500);
		show::view('views/errors/db.html', array('title' => $title, 'message' => $msg));
		}
}
