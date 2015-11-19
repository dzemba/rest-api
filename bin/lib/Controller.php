<?php
abstract class Controller{
	
	function __construct($params){
		$this -> class = get_class($this);
		$model = $this->getModel();
		$this -> model = new $model();
		$this->params = $params;
	}
	
	private function getModel()
	{
		return substr($this->class,0,-10).'Model';
	}
}