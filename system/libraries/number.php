<?php
class number extends helper {
static private $times = array(
	'picosecond' => 0.000000000001,
	'nanosecond' => 0.000000001,
	'microsecond' => 0.000001,
	'millisecond' => 0.001,
	'second' => 1,
	'minute' => 60,
	'hour' => 3600,
	'day' => 86400,
	'week' => 604800,
	'year' => 31536000
	);
	static public function timespan($seconds, $max = 3, $delim = ', ', $sep = ' ', $names = null, $plural = 's')
		{
		if ($names === null) {$names = self::$times;}
		$out = array();
		foreach (array_reverse($names) as $name => $sec)
			{
			if ($seconds >= $sec)
				{
				$found = floor($seconds/$sec);
				$seconds -= $found*$sec;
				$out[] = $found.$sep.$name.(($found == 1) ? '' : $plural);
				if (count($out) == $max) {break;}
				}
			}
		$out = implode($delim, $out);
		return $out;
		}
	public static function hex_to_rgb($hex)
		{
		return array(hexdec(substr($hex,0,2)),hexdec(substr($hex,2,2)),hexdec(substr($hex,4,2)));
		}
	public static function rgb_to_hex($rgb)
		{
		$hex = '';
		foreach ($rgb as &$value)
			{
			$value = dechex($value);
			if (strlen($value) == 1)
				{
				$value = $value.'0';
				}
			$hex .= $value;
			}
		return $hex;
		}
	public static function from_ip($ip)
		{
		$ip = explode('.', $ip);
		$newip = array();
		foreach ($ip as $segment)
			{
			$newip[] = str::pad_left(decbin($segment),8,'0');
			}
		$newip = implode('', $newip);
		$newip = bindec($newip);
		return $newip;
		}
	public static function to_ip($number)
		{
		$number = decbin($number);
		$number = str::pad_left($number, 32, '0');
		$number = str_split($number, 8);
		$number = array_map('bindec', $number);
		$number = implode('.', $number);
		return $number;
		}
}
