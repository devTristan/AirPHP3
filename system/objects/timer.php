<?php
class timer extends obj {
private $name;
public $timeline = array();
private $state = false; //true if timing.
	public function __construct($name)
		{
		$this->name = $name;
		//timers::register($this);
		}
	public function start()
		{
		$this->set_state(true);
		}
	public function stop()
		{
		$this->set_state(false);
		}
	private function set_state($state)
		{
		if ($this->state == $state) {return;}
		$this->state = $state;
		$this->timeline[] = array(microtime(true), $state);
		}
	public function elapsed()
		{
		$elapsed = 0;
		$last_on = 0;
		foreach ($this->timeline as $mark)
			{
			list($moment, $state) = $mark;
			if ($state)
				{
				$last_on = $moment;
				}
			else
				{
				$elapsed += $moment-$last_on;
				}
			}
		if ($state)
			{
			$elapsed += microtime(true)-$moment;
			}
		return $elapsed;
		}
	public function __toString()
		{
		return number_format($this->elapsed(), 3);
		}
}
