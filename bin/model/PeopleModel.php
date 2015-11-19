<?php
class PeopleModel extends Model{
	
	public $path = "./base/people";
	
	public function read_($params){
		
		$file = fopen($this->path, 'r');
		if(empty($params['p'])){
			while (($line = fgets($file)) !== false) {
				$exp = explode('/',str_replace("\r\n"," ",$line));
				$data[$exp[0]] = $exp;
			}
			if(empty($data)) $data = array('err' => 'brak pol');
		}else{
			while (($line = fgets($file)) !== false) {
				$exp = explode('/',str_replace("\r\n"," ",$line));
				if($exp[0] == $params['p']) return $exp;
			}
			$data = array('err' => 'brak wyniku o podanym id');
		} 
		
		fclose($file);
		return array($data);
	}
	
	public function update_($params){
		if(empty($params['p'])) return array('msg' => 'no data');
		else{
			$params['p'] = explode(',',$params['p']);
		}
		
		$file = fopen($this->path, 'r');
		while (($line = fgets($file)) !== false) {
			$exp = explode('/',str_replace("\r\n"," ",$line));
			$data[$exp[0]] = $exp;
		}
		fclose($file);
		
		if((int)$params['p'][0] < 1) return array('msg' => 'id jest mniejsze od 1 lub nie jest intem');
		else{
			if(!isset($data[(int)$params['p'][0]])) return array('msg' => 'nie istnieje pole o takim id');
			else{
				if(!isset($data[(int)$params['p'][0]][(int)$params['p'][1]])) return array('msg' => 'zly numer pola lub jego brak');
				else{
					$data[(int)$params['p'][0]][(int)$params['p'][1]] = isset($params['p'][2]) ? $params['p'][2] : NULL;
					
					$fp = fopen($this->path, 'w');
					$tmp ='';
					foreach($data as $value){ 
						$tmp = $tmp . implode("/",$value)."\r\n";
					}
					fwrite($fp,$tmp);	
					fclose ($fp);
					$msg = array('msg' => 'utworzono');
				}
			}
		}
		
		return array($msg);
	}
	
	public function create_($params){
		if(empty($params['p'])) return array('msg' => 'empty id');
		else{
			$params['p'] = explode(',',$params['p']);
		}
		
		$file = fopen($this->path, 'r');
		while (($line = fgets($file)) !== false) {
			$exp = explode('/',str_replace("\r\n"," ",$line));
			$data[$exp[0]] = $exp;
		}
		fclose($file);
		
		if((int)$params['p'][0] < 1) $msg = array('msg' => 'id jest mniejsze od 1 lub nie jest intem');
		else{
			if(isset($data[$params['p'][0]])) $msg = array('msg' => 'istnieje pole o takim id');
			else{
				
				$data[$params['p'][0]] = $params['p'];
				ksort($data);
				$fp = fopen($this->path, 'w');
				$tmp ='';
				foreach($data as $value){ 
					$tmp = $tmp . implode("/",$value)."\r\n";
					
				}
				fwrite($fp,$tmp);	
				fclose ($fp);
				$msg = array('msg' => 'utworzono');
			}
		}
		
		return array($msg);
	}
	
	public function delete_($params){
		if(empty($params['p'])) return array('msg' => 'empty id');
		
		$file = fopen($this->path, 'r');
		while (($line = fgets($file)) !== false) {
			$exp = explode('/',str_replace("\r\n"," ",$line));
			$data[$exp[0]] = $exp;
		}
		fclose($file);
		
		if((int)$params['p'][0] < 1) return array('msg' => 'id jest mniejsze od 1 lub nie jest intem');
		else{
			if(!isset($data[$params['p'][0]])) return array('msg' => 'nie istnieje pole o takim id');
			else{
				
				unset($data[$params['p'][0]]);
				$fp = fopen($this->path, 'w');
				$tmp ='';
				foreach($data as $value){ 
					$tmp = $tmp . implode("/",$value)."\r\n";
					
				}
				fwrite($fp,$tmp);	
				fclose ($fp);
				$msg = array('msg' => 'usunieto');
			}
		}
		
		return array($msg);
	}
	
}