<?php

class WorkersController extends Controller{
	
	function __construct($params){
		parent::__construct($params);
	}
		
	public function index(){
		$method = $this->params['method'].'_';
		$this->$method();
	}
	
	public function GET_(){
		echo "get";
	}

	public function PUT_(){
		echo "put";
	}
	
	public function POST_(){
		echo "get";
	}
	
	public function DELETE_(){
		echo "get";
	}

}