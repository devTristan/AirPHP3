<?php
//TODO: fix singleton
class field_has_one {
	public function set($value)
		{
		return is_object($value) ? $value[$value->model->identifier] : $value;
		}
	public function get($value, $args)
		{
		$model_name = $args[0];
		$model = s('models')->$model_name;
		return $model->get_one_by($model->identifier, $this->set($value));
		}
	public function __call($method, $args)
		{
		$model_name = $args[0][0];
		$model = s('models')->$model_name;
		$field = $model->fields[$model->identifier];
		$objname = array_shift($field);
		require_once(DIR_SYSTEM.DRIVERS.'/model/fields/'.$objname.'.php');
		$fieldobj = s('field_'.$objname);
		if (!isset($field[1])) {$field[1] = ($method == 'insert') ? $args[1] : array();}
		return call_user_func_array(array($fieldobj, $method), $field);
		}
}
