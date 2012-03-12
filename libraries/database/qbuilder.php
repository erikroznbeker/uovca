<?php
defined('_UOVCA') or die();

class queryBuilder {
	
	private $sql;
	
	public function __construct($sql){
		if(!$sql || !is_array($sql) || !count($sql))return false;
		
		$this->sql = Util::arrayToObject($sql);
	}
	
	public function build(){
		$table = $this->table();
		$fields = $this->fields();
		$where = $this->where();
		
		$sql = 'SELECT '.$fields.' FROM '.$table.' WHERE '.$where;
		
		return $sql;
	}
	
	private function table(){
		if(!isset($this->sql->from) || !is_string($this->sql->from) || !$this->sql->from){
			$this->error('Table is not defined');
			return false;
		}
		else return $this->sql->from;
	}
	
	private function where(){
		if(!isset($this->sql->where) || !is_object($this->sql->where) || !count($this->sql->where))return null;
		else{
			$out=array();
			foreach($this->sql->where as $field=>$condition){

				if(strtolower(substr($field, -6))==',rlike'){
					$field = substr($field, 0, strlen($field)-6);
					$condition = $condition.'%';
					$sign = 'LIKE';
				}
				else if(strtolower(substr($field, -6))==',llike'){
					$field = substr($field, 0, strlen($field)-6);
					$condition = '%'.$condition;
					$sign = 'LIKE';
				}
				else if(strtolower(substr($condition, -5))==',like'){
					$field = substr($field, 0, strlen($field)-5);
					$condition = '%'.substr($condition, strlen($condition)-5).'%';
					$sign = 'LIKE';
				}
				else{
					//$field = $field;
					//$condition = $condition;
					$sign = '=';
				}
				
				$out[]=$field." ".$sign." ".Db::esc($condition);
			}
			return implode(' AND ', $out);
		}
	}
	
	
	private function fields(){
		if(!isset($this->sql->fields) || !is_string(!$this->sql->fields) || !$this->sql->fields)return '*';
		else return $this->sql->fields;
	}
	
	private function error($msg){
		$out = '<div style="color:red">';
		$out.= 'Error in query builder: '.$msg;
		$out.='</div><hr /><pre>';
		
		echo $out;
		print_r($this->sql);
		die();
	}
	
	
}