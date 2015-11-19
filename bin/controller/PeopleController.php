<?php

class PeopleController extends Controller{
		
	function __construct($params){
		parent::__construct($params);
	}
		
	public function index(){
		$method = $this->params['method'].'_';
		$this->$method();
	}
	
	public function GET_(){
		echo json_encode($this->model->read_($this->params));
	}

	public function PUT_(){
		echo json_encode($this->model->update_($this->params));
	}
	
	public function POST_(){
		echo json_encode($this->model->create_($this->params));
	}
	
	public function DELETE_(){
		echo json_encode($this->model->delete_($this->params));
	}
	
}